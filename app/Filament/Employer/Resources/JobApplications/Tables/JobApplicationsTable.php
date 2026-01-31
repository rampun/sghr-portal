<?php

namespace App\Filament\Employer\Resources\JobApplications\Tables;

use App\Enums\JobApplication\StatusEnum;
use App\Enums\Jobs\StatusEnum as JobStatusEnum;
use App\Models\JobAds;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JobApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job.title')
                    ->label('Job Title'),
                TextColumn::make('jobseeker.name')
                    ->label('Applicant'),
                TextColumn::make('created_at')
                    ->label('Applied on')
                    ->date(),
            ])->filters([
               SelectFilter::make('job_ad_id')
                   ->label('Job Title')
                   ->options(function () {
                       return JobAds::where('user_id', auth()->id())->where('status', JobStatusEnum::ACTIVE->value)->pluck('title', 'id')->toArray();
                   }),
           ])
            ->modifyQueryUsing(function (Builder $query): Builder {
                return $query->where('status', StatusEnum::SHORTLISTED->value)->whereHas('job', function (Builder $jobQuery) {
                    $jobQuery->where('user_id', auth()->id());
                });
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
