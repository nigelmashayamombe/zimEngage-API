<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use App\Jobs\AnalyzeFeedbackSentiment;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFeedback extends ViewRecord
{
    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('reanalyze')
                ->label('Reanalyze Sentiment')
                ->action(function () {
                    AnalyzeFeedbackSentiment::dispatch($this->record);
                    
                    $this->notify('success', 'Sentiment analysis queued for processing.');
                }),
        ];
    }
} 