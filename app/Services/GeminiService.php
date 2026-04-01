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

        // Auto-detect the exact model name this specific API key is allowed to use
        try {
            $modelsResponse = Http::withoutVerifying()->get('https://generativelanguage.googleapis.com/v1beta/models?key=' . $apiKey);
            $validModel = 'models/gemini-1.5-flash'; // default
            
            if ($modelsResponse->successful()) {
                $models = collect($modelsResponse->json()['models'] ?? []);
                $availableModels = $models->pluck('name')->toArray();
                
                // Fallback to the first available model that supports generateContent
                if (in_array('models/gemini-1.5-flash', $availableModels)) {
                    $validModel = 'models/gemini-1.5-flash';
                } elseif (in_array('models/gemini-1.5-flash-latest', $availableModels)) {
                    $validModel = 'models/gemini-1.5-flash-latest';
                } elseif (in_array('models/gemini-pro', $availableModels)) {
                    $validModel = 'models/gemini-pro';
                } elseif (in_array('models/gemini-1.0-pro', $availableModels)) {
                    $validModel = 'models/gemini-1.0-pro';
                } elseif (count($availableModels) > 0) {
                    $validModel = $availableModels[0];
                }
            } else {
                 return "API Key Error: " . $modelsResponse->body();
            }
        } catch (\Exception $e) {
             return "Model Fetch Error: " . $e->getMessage();
        }

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
