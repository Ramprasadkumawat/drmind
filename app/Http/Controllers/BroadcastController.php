<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Broadcast;
use Auth;
use Illuminate\Support\Str;

class BroadcastController extends Controller
{
    function index()
    {
        $heading = "Broadcast";
        $broadcasts = Broadcast::all();
        return view('admin.broadcast.create_broadcast', compact('heading','broadcasts'));
    }
    function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'image' => 'nullable|mimetypes:video/mp4,video/avi,image/jpeg,image/jpg,image/png|max:20480',
            'title' => 'required|string|max:255',
        ]);

       

        if ($request->hasFile('image')) {
           
            $file = $request->file('image');
            $uploadPath = public_path('broadcast_images');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $originalExtension = strtolower($file->getClientOriginalExtension());
            
            if (in_array($originalExtension, ['mp4', 'mov', 'avi', 'wmv'])) {
                $extension = 'mp4';
            } else {
                $extension = $originalExtension;
            }
            
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $file->move($uploadPath, $filename);

            $validated['image'] = 'broadcast_images/' . $filename;
            $validated['extension'] = $extension;
            if (Auth::guard('web')->check()) {
                $validated['user_id'] = Auth::user()->id;
            }
            Broadcast::create($validated);
            return response()->json(['success' => true]);
            //return redirect()->back()->with('success', 'Broadcast created successfully.');
        }else{
            //return redirect()->back()->with('error', 'Broadcast not created.');
            return response()->json(['success' => false]);
        }

       

    }
    function delete($id)
    {
        $record = Broadcast::find($id);

        if (!$record) {
            return redirect()->route('broadcasts.index')->with('error', 'Broadcast not found.');
        }

        if ($record->image && file_exists(public_path($record->image))) {
            unlink(public_path($record->image));
        }

        $record->delete();

        return redirect()->route('broadcasts.index')->with('success', 'Broadcast deleted successfully.');
    }

    function UserBroadcast(){
        $heading = "Broadcast";
        $id = Auth::user()->id;
        $broadcasts = Broadcast::where('user_id',$id)->get();
        return view('user.broadcast.create_broadcast', compact('heading','broadcasts'));
    }
    function show(Request $request,$id){
    $broadcast = Broadcast::findOrFail($id);
    $userAgent = request()->header('User-Agent');
    $isTwitter = Str::contains($userAgent, 'Twitterbot');
    $isFacebookOrLinkedIn = Str::contains($userAgent, ['facebookexternalhit', 'LinkedInBot']);

    // Set platform-specific meta
    if ($isTwitter) {
        $meta = [
            'title' => 'Twitter Broadcast Title',
            'description' => 'Message for Twitter users',
            'image' => asset('twitter-image.jpg'),
            'url' => url()->current(),
            'type' => 'summary_large_image',
            'platform' => 'twitter'
        ];
    } else {
        $meta = [
            'title' => $broadcast->title,
            'description' => $broadcast->message,
            'image' => asset($broadcast->image),
            'url' => url()->current(),
            'type' => 'article',
            'platform' => 'og'
        ];
    }

    // Return the meta view (can auto redirect after meta loaded)
    return view('user.broadcast.broadcast-meta', compact('meta'));
    }
}
