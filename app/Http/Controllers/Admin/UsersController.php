<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    function index()
    {
        $users = DB::table('users')->get();

    // Create referral tree map
    $referralMap = [];
    foreach ($users as $user) {
        $referralMap[$user->referral_by][] = $user;
    }

    // Add level count to each user
    foreach ($users as $user) {
        $level1 = $referralMap[$user->referral_code] ?? [];
        $level2 = [];
        $level3 = [];

        foreach ($level1 as $l1) {
            $level2 = array_merge($level2, $referralMap[$l1->referral_code] ?? []);
        }

        foreach ($level2 as $l2) {
            if (is_object($l2) && property_exists($l2, 'referral_code')) {
                $level3 = array_merge($level3, $referralMap[$l2->referral_code] ?? []);
            }
        }

        $user->level1 = count($level1);
        $user->level2 = count($level2);
        $user->level3 = count($level3);
        $user->directMembers = $user->level1; // same as level 1
    }
        $heading="Users";
        return view('admin.users.users_list',compact('heading','users'));
    }
    function getHierarchy($referral_code){
        $users = \App\Models\User::all();
        $grouped = $users->groupBy('referral_by');
    
        // Get root user
        $rootUser = $users->firstWhere('referral_code', $referral_code);
    
        return view('admin.users.level_view', compact('grouped', 'rootUser'));
    }
    function tree(){
        $users = \App\Models\User::all();
        $grouped = $users->groupBy('referral_by');

        return view('admin.users.referrals_tree', compact('users', 'grouped'));
    }
}
