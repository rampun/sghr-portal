<?php

namespace App\Filament\User\Resources\SavedJobs\Pages;

use App\Filament\User\Resources\SavedJobs\SavedJobsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSavedJobs extends ListRecords
{
    protected static string $resource = SavedJobsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
