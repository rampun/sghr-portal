<?php

namespace App\Filament\User\Resources\ApplicationHistories\Pages;

use App\Filament\User\Resources\ApplicationHistories\ApplicationHistoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewApplicationHistory extends ViewRecord
{
    protected static string $resource = ApplicationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
