<?php

namespace App\Filament\Resources\JobApplications\Pages;

use App\Enums\JobApplication\StatusEnum;
use App\Filament\Resources\JobApplications\JobApplicationResource;
use App\Mail\ApplicationStatusChanged;
use App\Models\JobApplication;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ViewJobApplication extends ViewRecord
{
    protected static string $resource = JobApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
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
        ];
    }
}
