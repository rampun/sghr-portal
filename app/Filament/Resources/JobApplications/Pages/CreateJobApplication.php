<?php

namespace App\Filament\Resources\JobApplications\Pages;

use App\Filament\Resources\JobApplications\JobApplicationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJobApplication extends CreateRecord
{
    protected static string $resource = JobApplicationResource::class;
}
