<?php

namespace App\Filament\Resources\JobApplications\Tables;

use App\Enums\JobApplication\StatusEnum;
use App\Models\JobApplication;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class JobApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jobseeker.name')
                    ->label('User')
                    ->url(fn (JobApplication $record): string => route('filament.admin.resources.users.view', $record->user_id))
                    ->openUrlInNewTab()
                    ->searchable(),

                TextColumn::make('job.title')
                    ->label('Job Title')
                    ->url(fn (JobApplication $record): string => route('jobs.show', $record->job_ad_id))
                    ->openUrlInNewTab(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Applied on')
                    ->date(),
            ])
            ->filters([
                SelectFilter::make('job_ad_id')
                    ->label('Job Title')
                    ->options(function () {
                        return \App\Models\JobAds::pluck('title', 'id')->toArray();
                    }),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(StatusEnum::class),
            ])
            ->recordActions([
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
