<?php

namespace App\Filament\User\Resources\JobApplications\Pages;

use App\Filament\User\Resources\JobApplications\JobApplicationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJobApplication extends CreateRecord
{
    protected static string $resource = JobApplicationResource::class;
}
