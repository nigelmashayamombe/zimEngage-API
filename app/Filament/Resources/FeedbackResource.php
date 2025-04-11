<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Citizen Engagement';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable(),
                
                Forms\Components\Select::make('type')
                    ->options([
                        'complaint' => 'Complaint',
                        'suggestion' => 'Suggestion',
                        'inquiry' => 'Inquiry',
                        'praise' => 'Praise',
                        'other' => 'Other',
                    ])
                    ->required(),
                
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->rows(4),
                
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
                
                Forms\Components\Textarea::make('response')
                    ->rows(3),
                
                Forms\Components\TextInput::make('sentiment_score')
                    ->numeric()
                    ->disabled(),
                
                Forms\Components\TextInput::make('sentiment_label')
                    ->disabled(),
                
                Forms\Components\Select::make('assigned_to')
                    ->relationship('assignedTo', 'name')
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Citizen')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'complaint' => 'danger',
                        'suggestion' => 'warning',
                        'inquiry' => 'info',
                        'praise' => 'success',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('message')
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'in_progress' => 'warning',
                        'resolved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('sentiment_label')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'POSITIVE' => 'success',
                        'NEGATIVE' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'complaint' => 'Complaint',
                        'suggestion' => 'Suggestion',
                        'inquiry' => 'Inquiry',
                        'praise' => 'Praise',
                        'other' => 'Other',
                    ]),
                
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved',
                        'rejected' => 'Rejected',
                    ]),
                
                Tables\Filters\SelectFilter::make('sentiment_label')
                    ->options([
                        'POSITIVE' => 'Positive',
                        'NEGATIVE' => 'Negative',
                        'NEUTRAL' => 'Neutral',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
            'view' => Pages\ViewFeedback::route('/{record}'),
        ];
    }
} 