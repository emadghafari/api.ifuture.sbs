<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use App\Models\Investment;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    // 1. Create Stripe Payment Intent
    public function createStripeIntent(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $stripeSecret = Setting::where('key', 'payment_stripe_secret')->value('value');
        if (!$stripeSecret) {
            return response()->json(['error' => 'Stripe is not configured on this server.'], 400);
        }

        Stripe::setApiKey($stripeSecret);

        try {
            // Amount must be in cents for Stripe ($10.00 = 1000)
            $intent = PaymentIntent::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'metadata' => [
                    'project_id' => $request->project_id,
                    'user_id' => $request->user()->id,
                ],
            ]);

            return response()->json([
                'clientSecret' => $intent->client_secret,
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // 2. Confirm Investment (Called after successful payment on frontend)
    public function captureInvestment(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|numeric|min:1',
            'shares' => 'required|integer|min:1',
            'gateway' => 'required|in:stripe,paypal',
            'transaction_id' => 'required|string',
        ]);

        // Verify it isn't a duplicate transaction
        if (Investment::where('transaction_id', $request->transaction_id)->exists()) {
            return response()->json(['error' => 'Transaction already processed'], 400);
        }

        $investment = Investment::create([
            'user_id' => $request->user()->id,
            'project_id' => $request->project_id,
            'amount' => $request->amount,
            'shares' => $request->shares,
            'gateway' => $request->gateway,
            'transaction_id' => $request->transaction_id,
            'status' => 'successful',
        ]);

        // Increment project funding
        $project = Project::find($request->project_id);
        $project->current_amount += $request->amount;
        $project->save();

        return response()->json(['message' => 'Investment captured successfully!', 'investment' => $investment]);
    }
}
