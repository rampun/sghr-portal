<?php

namespace App\Filament\User\Resources\SavedJobs\Pages;

use App\Filament\User\Resources\SavedJobs\SavedJobsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSavedJobs extends EditRecord
{
    protected static string $resource = SavedJobsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
