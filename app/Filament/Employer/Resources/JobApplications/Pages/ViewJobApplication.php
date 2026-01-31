<?php

namespace App\Filament\Employer\Resources\JobApplications\Pages;

use App\Filament\Employer\Resources\JobApplications\JobApplicationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJobApplication extends ViewRecord
{
    protected static string $resource = JobApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
