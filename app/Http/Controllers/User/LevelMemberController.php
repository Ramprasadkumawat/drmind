<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LevelMemberController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // dd($user); die;
        $level1 = $user->level1Referrals;
        // dd($level1);die;
        $level2 = User::whereIn('referral_by', function ($query) use ($user) {
            $query->select('referral_code')
                ->from('users')
                ->where('referral_by', $user->referral_code);
        })->get();

        return view('level_member.level_member', compact('level1', 'level2'));
    }
    public function showTree()
    {
        $user = auth()->user(); // or specific user
        $tree = $this->buildReferralTree($user);
        // echo "<pre>";
        // print_r($tree);die;

        return view('level_member.tree_view', compact('tree'));
    }
   private function buildReferralTree($user)
{
    $level1 = User::where('referral_by', $user->referral_code)->get();

    $children = $level1->map(function ($child) {
        $level1Count = User::where('referral_by', $child->referral_code)->count();
        $level2Count = User::whereIn('referral_by', function ($q) use ($child) {
            $q->select('referral_code')->from('users')->where('referral_by', $child->referral_code);
        })->count();

        return [
            'id' => $child->id,
            'name' => $child->name,
            'referral_code' => $child->referral_code,
            'level1_count' => $level1Count,
            'level2_count' => $level2Count,
            'children' => $this->buildReferralTree($child)['children'], // Important fix
        ];
    })->toArray();

    return [
        'id' => $user->id,
        'name' => $user->name,
        'referral_code' => $user->referral_code,
        'level1_count' => count($children),
        'level2_count' => array_sum(array_column($children, 'level1_count')),
        'children' => $children,
    ];
}
}
