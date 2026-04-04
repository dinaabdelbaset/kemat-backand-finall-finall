<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY', '');
    }

    /**
     * Send a prompt to Gemini with system context.
     */
    public function ask(string $prompt, string $systemContext = '')
    {
        if (empty($this->apiKey)) {
            return "Error: Gemini API Key is missing in the environment variables.";
        }

        $apiKey = trim($this->apiKey);

        // Found the issue: Gemini 1.5 is stripped from the user's tier, and 2.x versions have 0 quota.
        // We will use the universal 'models/gemini-flash-latest' which is supported by their key.
        $validModel = 'models/gemini-flash-latest';
        
        $url = 'https://generativelanguage.googleapis.com/v1beta/' . $validModel . ':generateContent?key=' . $apiKey;

        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $systemContext . "\n\nUser Question: " . $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.5,
                'maxOutputTokens' => 800,
            ]
        ];

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, $payload);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    return $data['candidates'][0]['content']['parts'][0]['text'];
                }
                return "Gemini Structure Error: " . json_encode($data);
            }
            return "Gemini Connection Error (HTTP " . $response->status() . "): " . $response->body();
        } catch (\Exception $e) {
            return "System Exception: " . $e->getMessage();
        }
    }
}
