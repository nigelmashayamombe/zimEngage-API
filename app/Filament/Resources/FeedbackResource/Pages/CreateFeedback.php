<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use App\Jobs\AnalyzeFeedbackSentiment;
use Filament\Resources\Pages\CreateRecord;

class CreateFeedback extends CreateRecord
{
    protected static string $resource = FeedbackResource::class;
    
    protected function afterCreate(): void
    {
        // Analyze sentiment after feedback creation
        AnalyzeFeedbackSentiment::dispatch($this->record);
    }
} 