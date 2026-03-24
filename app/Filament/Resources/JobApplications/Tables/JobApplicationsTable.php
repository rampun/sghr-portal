<?php

namespace App\Filament\Resources\JobApplications\Tables;

use App\Enums\JobApplication\StatusEnum;
use App\Mail\ApplicationStatusChanged;
use App\Models\JobApplication;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
                ViewAction::make(),
                EditAction::make()
                    ->after(function (JobApplication $record) {
                        // Get the changed fields
                        $changes = $record->getChanges();

                        // Remove timestamps from changes
                        unset($changes['updated_at']);

                        // Check if status was changed
                        if (isset($changes['status'])) {
                            // Send email
                            if (in_array($changes['status'], [StatusEnum::ACCEPTED->value, StatusEnum::REJECTED->value])) {
                                try {
                                    Mail::to($record->jobseeker->email)->send(new ApplicationStatusChanged($record, $changes['status']));
                                    Notification::make()
                                        ->title('Application status change email sent to '.$record->jobseeker->email)
                                        ->success()
                                        ->send();
                                    Log::info('Successfully sent to: '.$record->jobseeker->email);
                                } catch (\Exception $e) {
                                    Log::error('Failed to send to '.$record->jobseeker->email, [
                                        'error' => $e->getMessage(),
                                    ]);
                                }
                            }
                        }
                    }),
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
