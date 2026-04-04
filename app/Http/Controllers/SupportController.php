<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Your message has been received. We will get back to you shortly!'
        ], 201);
    }

    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $existing = NewsletterSubscriber::where('email', $validated['email'])->first();
        if ($existing) {
            return response()->json(['success' => true, 'message' => 'You are already subscribed!']);
        }

        NewsletterSubscriber::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Successfully subscribed to our newsletter!'
        ], 201);
    }
}
