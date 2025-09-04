<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BroadcastClick;
use App\Models\Broadcast;

class BroadcastAnalyticsController extends Controller
{
    public function index()
    {
        $broadcasts = Broadcast::whereHas('clicks')->with('clicks.user')->get();
        $platforms = ['facebook', 'instagram', 'twitter', 'whatsapp', 'wechat', 'tiktok', 'youtube'];
        return view('admin.broadcast.analytics', compact('broadcasts', 'platforms'));
    }

    public function trackClick(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|in:facebook,instagram,wechat,whatsapp,tiktok,youtube',
            'broadcast_id' => 'required|exists:broadcast,id',
        ]);

        $platform = $request->input('platform');
        $broadcastId = $request->input('broadcast_id');
        $columnName = "{$platform}_count";

        Broadcast::where('id', $broadcastId)->increment($columnName);

        return response()->json(['success' => true]);
    }
}
