<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService;
use App\Models\Tour;
use App\Models\Product;

class ChatbotController extends Controller
{
    private GeminiService $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $userMessage = $request->input('message');

        // Dynamically build context from Database (RAG approach)
        $tours = Tour::select('title', 'location', 'price', 'duration', 'description')->take(10)->get();
        $products = collect(); // If products table exists, we can fetch
        if (\Schema::hasTable('products')) {
             $products = Product::select('name', 'category', 'price', 'description')->take(10)->get();
        }

        // Build the system prompt
        $context = "You are 'Kamet AI', a helpful, professional, and friendly travel assistant working exclusively for 'Kamet Tours', an Egyptian travel and booking company.
Your main job is to assist users in booking tours, buying traditional souvenirs, and answering travel-related questions based STRICTLY on the data provided below.
If the user greets you or asks how you are doing, be very friendly, conversational, and completely human-like in your response before asking how you can help them with travel. Do not act like a rigid robot.
However, if they ask about complex unrelated topics (coding, politics, etc), politely remind them you are a travel assistant.
Speak in the exactly same language and dialect the user speaks (e.g. Egyptian Arabic slang if they use it). Be concise, persuasive, and warm.

--- OUR AVAILABLE TOURS DATA ---
" . $tours->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "

--- OUR SOUVENIR SHOP DATA ---
" . $products->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "
";

        // Call Gemini
        $reply = $this->geminiService->ask($userMessage, $context);

        return response()->json([
            'answer' => $reply
        ]);
    }
}
