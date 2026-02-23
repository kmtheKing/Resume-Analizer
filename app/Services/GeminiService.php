<?php

namespace App\Services;

use App\Exceptions\GeminiApiException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function analyzeResume(string $text): array
    {
        $prompt = "Analyze the following resume text and extract key information in JSON format. 
        Include 'skills' (array), 'experience' (array of objects with title, company, duration), 
        'education' (array of objects), and a 'summary'.
        
        Resume Text:
        $text";

        $response = $this->callGemini($prompt);
        return $this->parseAndValidateJson($response, ['skills', 'experience', 'education', 'summary']);
    }

    public function matchJob(string $resumeText, string $jobDescription): array
    {
        $prompt = "Compare the following resume against the job description. 
        Provide a 'match_score' (0-100) and 'feedback' (strengths, weaknesses, suggestions) in JSON format.
        
        Resume:
        $resumeText
        
        Job Description:
        $jobDescription";

        $response = $this->callGemini($prompt);
        return $this->parseAndValidateJson($response, ['match_score', 'feedback']);
    }

    protected function callGemini(string $prompt): string
    {
        if (empty($this->apiKey) || $this->apiKey === 'your_api_key_here') {
            throw new GeminiApiException('Gemini API key is not configured. Please add your GEMINI_API_KEY to the .env file.');
        }

        try {
            $options = [];
            if (app()->environment('local')) {
                $options['verify'] = false; // Disable SSL verification for local dev if needed
            }

            $response = Http::withOptions($options)->post("{$this->baseUrl}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'responseMimeType' => 'application/json',
                ]
            ]);

            if (!$response->successful()) {
                Log::error('Gemini API Full Error Response: ' . $response->body());
                $errorData = $response->json();
                $errorMessage = $errorData['error']['message'] ?? 'Unknown API error';
                throw new GeminiApiException("Gemini API error: {$errorMessage}", $response->status(), null, $errorData);
            }

            $responseText = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if ($responseText === null) {
                Log::error('Gemini API Response Format Error: ' . $response->body());
                throw new GeminiApiException('Unexpected response format from Gemini API.');
            }

            return $responseText;
        } catch (\Exception $e) {
            if ($e instanceof GeminiApiException) {
                throw $e;
            }
            Log::error('Gemini Service Exception: ' . $e->getMessage());
            throw new GeminiApiException('An unexpected error occurred while communicating with Gemini API.', 0, $e);
        }
    }

    protected function parseAndValidateJson(?string $json, array $requiredFields): array
    {
        if ($json === null) {
            return [];
        }

        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Gemini Response JSON Decode Error: ' . json_last_error_msg() . ' | Content: ' . $json);
            return [];
        }

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                Log::warning("Gemini Response missing required field: {$field}");
                // We can either set a default or just log it. 
                // For now, let's ensure the key exists to avoid undefined index errors in controllers.
                if (!array_key_exists($field, $data)) {
                    $data[$field] = null;
                }
            }
        }

        return $data;
    }
}
