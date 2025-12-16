<?php

namespace App\Filament\Resources\JobApplications\Tables;

use App\Models\JobApplication;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
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
                // TrashedFilter::make(),
            ])
            ->recordActions([
                // ViewAction::make(),
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
