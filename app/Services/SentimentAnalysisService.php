<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

final class SentimentAnalysisService
{
    private string $apiUrl = 'https://api-inference.huggingface.co/models/distilbert-base-uncased-finetuned-sst-2-english';
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.huggingface.api_key');
    }

    /**
     * Analyze the sentiment of a given text.
     *
     * @param string $text
     * @return array{score: float, label: string}
     */
    public function analyze(string $text): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl, [
                'inputs' => $text,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                
                // Handle different response formats
                if (isset($result[0]) && is_array($result[0])) {
                    // Extract the sentiment with highest score
                    $sentiment = collect($result[0])->sortByDesc('score')->first();
                    
                    return [
                        'score' => $sentiment['score'],
                        'label' => $sentiment['label'],
                    ];
                }
                
                Log::warning('Unexpected response format from Hugging Face API', ['response' => $result]);
                return [
                    'score' => 0.5,
                    'label' => 'NEUTRAL',
                ];
            }
            
            Log::error('Failed to get sentiment from Hugging Face API', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);
            
            return [
                'score' => 0.5,
                'label' => 'NEUTRAL',
            ];
        } catch (Exception $e) {
            Log::error('Error analyzing sentiment', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return [
                'score' => 0.5,
                'label' => 'NEUTRAL',
            ];
        }
    }
} 