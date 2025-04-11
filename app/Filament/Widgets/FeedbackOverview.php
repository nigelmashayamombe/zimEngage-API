<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FeedbackOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalFeedback = Feedback::count();
        $positiveCount = Feedback::where('sentiment_label', 'POSITIVE')->count();
        $negativeCount = Feedback::where('sentiment_label', 'NEGATIVE')->count();
        $neutralCount = $totalFeedback - $positiveCount - $negativeCount;
        
        $positivePercentage = $totalFeedback > 0 ? round(($positiveCount / $totalFeedback) * 100, 1) : 0;
        $negativePercentage = $totalFeedback > 0 ? round(($negativeCount / $totalFeedback) * 100, 1) : 0;
        $neutralPercentage = $totalFeedback > 0 ? 100 - $positivePercentage - $negativePercentage : 0;
        
        $pendingCount = Feedback::where('status', 'pending')->count();
        $resolvedCount = Feedback::where('status', 'resolved')->count();
        
        return [
            Stat::make('Total Feedback', $totalFeedback)
                ->description('Total citizen feedback submitted')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('primary'),
            
            Stat::make('Positive Sentiment', "{$positiveCount} ({$positivePercentage}%)")
                ->description('Feedback with positive sentiment')
                ->descriptionIcon('heroicon-m-face-smile')
                ->color('success'),
            
            Stat::make('Negative Sentiment', "{$negativeCount} ({$negativePercentage}%)")
                ->description('Feedback with negative sentiment')
                ->descriptionIcon('heroicon-m-face-frown')
                ->color('danger'),
            
            Stat::make('Pending', $pendingCount)
                ->description('Feedback awaiting response')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            
            Stat::make('Resolved', $resolvedCount)
                ->description('Feedback issues resolved')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
} 