<?php

namespace App\Filament\User\Resources\ApplicationHistories\Pages;

use App\Filament\User\Resources\ApplicationHistories\ApplicationHistoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditApplicationHistory extends EditRecord
{
    protected static string $resource = ApplicationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
