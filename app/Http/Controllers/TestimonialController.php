<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    function index(){
        $testimonial = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonial'));
    }
    function create(Request $request,$id=null){
        $testimonial=[];
        if($id){
            $testimonial = Testimonial::find($id);
        }
        return view('admin.testimonials.create',compact('testimonial'));
    }
    function store(Request $request){
        $validate = $request->
        validate([
            'title' =>'required',
            'description' =>'required',
            ]);
        $validate['status'] = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('testimonial_images');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $validate['image'] = asset('testimonial_images/' . $filename);
        }
        if(isset($request->id)){
            $msg= "Testimonial Updated Successfully";
            Testimonial::where('id',$request->id)->update($validate);
        }else{
            Testimonial::create($validate);
            $msg = 'Testimonial created successfully';
        }
        return redirect()->back()->with('success',$msg);

    }
    public function uploadImage(Request $request)
    {
    if ($request->hasFile('upload')) {
        $file = $request->file('upload');
        $destination = public_path('testimonial_images');
        $extension = $file->getClientOriginalExtension();

        $filename = Str::random(20) . '.' . $extension;

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);
        $url = asset('testimonial_images/' . $filename);

        return response()->json([
            'url' => $url
        ],200);
    }

    return response()->json([
        'error' => [
            'message' => 'No file uploaded.'
        ]
    ], 400);
}



}
