<?php

namespace App\Filament\User\Resources\ApplicationHistories\Pages;

use App\Filament\User\Resources\ApplicationHistories\ApplicationHistoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateApplicationHistory extends CreateRecord
{
    protected static string $resource = ApplicationHistoryResource::class;
}
