<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        // Simulate payment processing
        // In production, integrate with Stripe/PayPal/Paymob here
        $transactionId = 'TXN-' . strtoupper(substr(md5(uniqid()), 0, 10));

        return response()->json([
            'success' => true,
            'transactionId' => $transactionId,
            'message' => 'Payment processed successfully',
        ]);
    }

    public function status($transactionId)
    {
        // In production, check actual payment gateway status
        return response()->json([
            'transactionId' => $transactionId,
            'status' => 'Paid',
        ]);
    }
}
