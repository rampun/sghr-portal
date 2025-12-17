<?php

namespace App\Filament\User\Resources\SavedJobs\Tables;

use App\Models\SavedJobs;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SavedJobsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job_ad_id')
                    ->label('Ref')
                    ->url(fn (SavedJobs $record): string => route('jobs.show', $record->job_ad_id))
                    ->openUrlInNewTab(),
                TextColumn::make('job.title')
                    ->label('Job Title'),
                TextColumn::make('created_at')
                    ->label('Saved on')
                    ->date(),
            ])
            ->filters([
                //
            ])

            ->modifyQueryUsing(function (Builder $query): Builder {
                return $query->where('user_id', auth()->id()); // only show jobs linked to logged in user
            })
            ->recordActions([
                // ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
