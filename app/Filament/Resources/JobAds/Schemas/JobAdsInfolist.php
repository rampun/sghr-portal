<?php

namespace App\Filament\Resources\JobAds\Schemas;

use App\Models\JobAds;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class JobAdsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID')
                    ->columnSpanFull(),
                TextEntry::make('title')->label('Job Title')
                    ->placeholder('-'),
                TextEntry::make('industry')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('experience')
                    ->label('Experience Required')
                    ->placeholder('-'),
                TextEntry::make('type')
                    ->placeholder('-'),
                TextEntry::make('location')
                    ->placeholder('-'),
                TextEntry::make('salary_min_range')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('salary_max_range')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('start_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('duration')
                    ->placeholder('-'),
                TextEntry::make('employer.company_name')
                    ->label('Employer Name')
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->date()
                    ->visible(fn(JobAds $record): bool => $record->trashed()),
            ]);
    }
}
