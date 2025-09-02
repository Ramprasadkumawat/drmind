<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SocialClickController extends Controller
{
    public function trackClick(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        if ($user) {
            $user->increment('social_clicks_count');
            return response()->json(['message' => 'Click tracked successfully!']);
        } else {
            return response()->json(['message' => 'User not authenticated.'], 401);
        }
    }
}
