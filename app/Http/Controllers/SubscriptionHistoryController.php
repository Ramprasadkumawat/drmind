<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\UserSubscription;

class SubscriptionHistoryController extends Controller
{
    public function subscriptionHistory(Request $request)
    {
        $id = Auth()->id();
        $subscriptions = UserSubscription::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
           
        return view('user.subscription.subscription', compact('subscriptions'));
    }
    public function cancelSubscription(Request $request)
    {
        $user = $request->user();
        $subscription = $user->subscriptions()->where('stripe_status', 'active')->first();

        if ($subscription) {
            $subscription->update(['stripe_status' => 'canceled']);
            // Optionally, you can also handle the Stripe cancellation logic here
        }

        return redirect()->route('subscription.history')->with('status', 'Subscription canceled successfully.');
    }
    public function success(Request $request)
    {
        // Handle the success logic after subscription creation
        return redirect()->route('subscription.history')->with('status', 'Subscription created successfully.');
    }
}
