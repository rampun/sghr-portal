<?php

namespace App\Filament\Resources\JobAds\Tables;

use App\Enums\Jobs\StatusEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class JobAdsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('type'),
                TextColumn::make('location'),
                TextColumn::make('employer.company_name')
                    ->label('Employer')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
            ])->filters([
                SelectFilter::make('user_id')
                    ->label('Company')
                    ->options(function () {
                        return \App\Models\User::where('company_name', '!=', null)->pluck('company_name', 'id')->toArray();
                    }),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(StatusEnum::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
