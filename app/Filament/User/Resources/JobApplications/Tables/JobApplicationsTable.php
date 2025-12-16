<?php

namespace App\Filament\User\Resources\JobApplications\Tables;

use App\Models\JobApplication;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JobApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job_ad_id')
                    ->label('Ref')
                    ->url(fn (JobApplication $record): string => route('jobs.show', $record->job_ad_id))
                    ->openUrlInNewTab(),
                TextColumn::make('job.title')
                    ->label('Job Title'),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Applied on')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->modifyQueryUsing(function (Builder $query): Builder {
                return $query->where('user_id', auth()->id()); // only show jobs linked to logged in user
            })
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
