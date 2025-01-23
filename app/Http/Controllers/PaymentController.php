<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
{
    Stripe::setApiKey('sk_test_51QV9aiP3R10z9hqGG2BgTffJo56vwGSVcb33IN1qQT4O9ujzAE2aEm3eyP398OLBLS2dWPk9OenEdTbwxQE1W81H001eIv2L1O');

    try {
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,club_id',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
        ]);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => $validated['description'],
                    ],
                    'unit_amount' => $validated['amount'] * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['club_id' => $validated['club_id']]),
            'cancel_url' => route('payment.cancel'),
        ]);

        return response()->json([
            'success' => true,
            'url' => $session->url,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while creating the payment session: ' . $e->getMessage(),
        ]);
    }
}

public function success(Request $request, $club_id)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You need to log in to join this club.');
    }

    $user = Auth::user();
    if ($user->joinedClubs()->where('memberships.club_id', $club_id)->exists()) {
        return redirect()->route('clubs.my')->with('error', 'You are already a member of this club.');
    }

    $user->joinedClubs()->attach($club_id, [
        'join_date' => now(),
        'membership_fee' => 100.00,
    ]);

    return redirect()->route('clubs.my')->with('success', 'Payment successful! You have joined the club.');
}

public function cancel()
{
    return redirect()->route('clubs.my')->with('error', 'Payment was canceled.');
}

}