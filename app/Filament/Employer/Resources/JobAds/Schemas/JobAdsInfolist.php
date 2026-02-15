<?php

namespace App\Filament\Employer\Resources\JobAds\Schemas;

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
                        TextEntry::make('title')->label('Position')
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
                        TextEntry::make('salary_min_range')
                            ->label('Min salary (USD/month)')
                            ->numeric()
                            ->placeholder('-'),
                        TextEntry::make('salary_max_range')
                            ->label('Max salary (USD/month)')
                            ->numeric()
                            ->placeholder('-'),
                        TextEntry::make('location')
                            ->placeholder('-'),
                        TextEntry::make('status')
                            ->badge()
                            ->placeholder('-'),
                    ])->columnSpan('full')
                    ->columns(2),
            ]);
    }
}
