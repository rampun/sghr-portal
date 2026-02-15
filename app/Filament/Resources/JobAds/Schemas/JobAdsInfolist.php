<?php

namespace App\Filament\Resources\JobAds\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JobAdsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Job Detail')
                    ->components([
                        TextEntry::make('title')->label('Job Title')
                            ->placeholder('-'),
                        TextEntry::make('industry')
                            ->placeholder('-'),
                        TextEntry::make('description')
                            ->html()
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

                    ])->columnSpan('full')
                    ->columns(2),
            ]);
    }
}
