<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\ChartWidget;

class FeedbackSentimentDistribution extends ChartWidget
{
    protected static ?string $heading = 'Sentiment Distribution';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $totalFeedback = Feedback::count();
        
        if ($totalFeedback === 0) {
            return [
                'datasets' => [
                    [
                        'data' => [1],
                        'backgroundColor' => ['rgb(156, 163, 175)'],
                    ],
                ],
                'labels' => ['No feedback yet'],
            ];
        }
        
        $positiveCount = Feedback::where('sentiment_label', 'POSITIVE')->count();
        $negativeCount = Feedback::where('sentiment_label', 'NEGATIVE')->count();
        $neutralCount = $totalFeedback - $positiveCount - $negativeCount;
        
        return [
            'datasets' => [
                [
                    'data' => [$positiveCount, $negativeCount, $neutralCount],
                    'backgroundColor' => [
                        'rgb(34, 197, 94)', // Green for positive
                        'rgb(239, 68, 68)', // Red for negative
                        'rgb(156, 163, 175)', // Gray for neutral/unprocessed
                    ],
                ],
            ],
            'labels' => ['Positive', 'Negative', 'Neutral/Unprocessed'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
} 