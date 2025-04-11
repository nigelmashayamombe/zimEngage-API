<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Feedback;
use App\Services\SentimentAnalysisService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

final class AnalyzeFeedbackSentiment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Feedback $feedback
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(SentimentAnalysisService $sentimentService): void
    {
        try {
            // Analyze sentiment
            $result = $sentimentService->analyze($this->feedback->message);
            
            // Update the feedback with sentiment score and label
            $this->feedback->update([
                'sentiment_score' => $result['score'],
                'sentiment_label' => $result['label'],
            ]);
            
            Log::info('Successfully analyzed sentiment for feedback', [
                'feedback_id' => $this->feedback->id,
                'sentiment_score' => $result['score'],
                'sentiment_label' => $result['label'],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to analyze sentiment for feedback', [
                'feedback_id' => $this->feedback->id,
                'error' => $e->getMessage(),
            ]);
            
            // Release the job to try again later
            $this->release(60);
        }
    }
} 