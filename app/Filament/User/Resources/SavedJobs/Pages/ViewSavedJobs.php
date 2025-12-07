<?php

namespace App\Filament\User\Resources\SavedJobs\Pages;

use App\Filament\User\Resources\SavedJobs\SavedJobsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSavedJobs extends ViewRecord
{
    protected static string $resource = SavedJobsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
