<?php

namespace App\Filament\Employer\Resources\JobApplications\Pages;

use App\Filament\Employer\Resources\JobApplications\JobApplicationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJobApplication extends CreateRecord
{
    protected static string $resource = JobApplicationResource::class;
}
