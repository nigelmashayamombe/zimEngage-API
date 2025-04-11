<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class FeedbackSentimentChart extends ChartWidget
{
    protected static ?string $heading = 'Sentiment Analysis Trends';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $days = 30;
        $period = now()->subDays($days)->format('Y-m-d');
        
        $feedbackByDay = Feedback::where('created_at', '>=', $period)
            ->select([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(CASE WHEN sentiment_label = "POSITIVE" THEN 1 END) as positive'),
                DB::raw('COUNT(CASE WHEN sentiment_label = "NEGATIVE" THEN 1 END) as negative'),
                DB::raw('COUNT(CASE WHEN sentiment_label IS NULL OR sentiment_label NOT IN ("POSITIVE", "NEGATIVE") THEN 1 END) as neutral'),
            ])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $dates = collect(range(0, $days - 1))
            ->map(fn (int $daysAgo) => now()->subDays($daysAgo)->format('Y-m-d'))
            ->reverse();
        
        $positiveData = [];
        $negativeData = [];
        $neutralData = [];
        
        foreach ($dates as $date) {
            $feedbackOnDate = $feedbackByDay->firstWhere('date', $date);
            
            $positiveData[] = $feedbackOnDate ? $feedbackOnDate->positive : 0;
            $negativeData[] = $feedbackOnDate ? $feedbackOnDate->negative : 0;
            $neutralData[] = $feedbackOnDate ? $feedbackOnDate->neutral : 0;
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Positive',
                    'data' => $positiveData,
                    'backgroundColor' => 'rgb(34, 197, 94)',
                    'borderColor' => 'rgb(34, 197, 94)',
                ],
                [
                    'label' => 'Negative',
                    'data' => $negativeData,
                    'backgroundColor' => 'rgb(239, 68, 68)',
                    'borderColor' => 'rgb(239, 68, 68)',
                ],
                [
                    'label' => 'Neutral',
                    'data' => $neutralData,
                    'backgroundColor' => 'rgb(156, 163, 175)',
                    'borderColor' => 'rgb(156, 163, 175)',
                ],
            ],
            'labels' => $dates->map(fn (string $date) => Carbon::parse($date)->format('M j')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
} 