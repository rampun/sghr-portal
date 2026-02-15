<?php

namespace App\Filament\Resources\JobApplications\Pages;

use App\Filament\Resources\JobApplications\JobApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use App\Enums\JobApplication\StatusEnum;
use App\Mail\ApplicationStatusChanged;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EditJobApplication extends EditRecord
{
    protected static string $resource = JobApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    // protected function afterSave(): void
    // {
    //     // Get the updated record
    //     $record = $this->record;

    //     // Get the changed fields
    //     $changes = $record->getChanges();

    //     // Remove timestamps from changes
    //     unset($changes['updated_at']);

    //     // Check if status was changed
    //     if (isset($changes['status'])) {
    //         // Send email
    //         if (in_array($changes['status'], [StatusEnum::ACCEPTED->value, StatusEnum::REJECTED->value])) {
    //             try {
    //                 Mail::to($record->jobseeker->email)->send(new ApplicationStatusChanged($record, $changes['status']));
    //                 Notification::make()
    //                     ->title('Application status change email sent to ' . $record->jobseeker->email)
    //                     ->success()
    //                     ->send();
    //                 Log::info('Successfully sent to: ' . $record->jobseeker->email);
    //             } catch (\Exception $e) {
    //                 Log::error('Failed to send to ' . $record->jobseeker->email, [
    //                     'error' => $e->getMessage(),
    //                 ]);
    //             }
    //         }
    //     } else {
    //         Log::info('No status change detected for Job Application ID: ' . $record->id);
    //     }
    // }
}
