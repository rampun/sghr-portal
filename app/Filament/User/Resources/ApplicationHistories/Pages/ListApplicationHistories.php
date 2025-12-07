<?php

namespace App\Filament\User\Resources\ApplicationHistories\Pages;

use App\Filament\User\Resources\ApplicationHistories\ApplicationHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApplicationHistories extends ListRecords
{
    protected static string $resource = ApplicationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
