<?php

namespace App\Filament\User\Resources\SavedJobs\Pages;

use App\Filament\User\Resources\SavedJobs\SavedJobsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSavedJobs extends CreateRecord
{
    protected static string $resource = SavedJobsResource::class;
}
