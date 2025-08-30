<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\UserSubscription as Subscription;
use Auth;

class DashboardController extends Controller
{
    function index()
    {
       
        $user = Auth::user();
        $myReferralCode = $user->referral_code;
        $earningPoint = $user->earning_point;
        $levelPoint = $user->level_earning;
       
        $levelOneUsers = User::where('referral_by', $myReferralCode)->get();
        $levelOneCount = $levelOneUsers->count();

        // 2nd level referrals
        $levelOneCodes = $levelOneUsers->pluck('referral_code');
        $levelTwoCount = User::whereIn('referral_by', $levelOneCodes)->count();

        // Total referrals (2-level)
        $totalTwoLevelReferralCount = $levelOneCount + $levelTwoCount;

        $allOrder = Order::where('user_id',$user->id)->count();
        $allSubscription = Subscription::where('user_id',$user->id)->count();
        
        $data = [
        'earning_point' => $earningPoint,
        'level_point'   => $levelPoint,
        'direct_referrals' => $levelOneCount,
        'second_level_referrals' => $levelTwoCount,
        'total_two_level_referrals' => $totalTwoLevelReferralCount,
        'orders' => $allOrder,
        'subscription'=>$allSubscription,
        'my_code'=>$myReferralCode,
        'title' => "Dashboard"
        ];

        return view('user.dashboard.index', $data);
    }
    function profile()
    {
        $title = "User Profile";
        return view('user.account.profile', compact('title'));
    }
    function profileUpdate(Request $request)
    { 
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|numeric',
        ]);
        $user = auth()->user();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'] ?? $user->phone; // Keep existing phone if not provided
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    function settings()
    {
        $title = "User Settings";
        return view('user.account.setting', compact('title'));
    }
    function settingsUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
        }

        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return back()->with('success', 'Password updated successfully');
    }
    
}
