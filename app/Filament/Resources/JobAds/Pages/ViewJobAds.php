<?php

namespace App\Filament\Resources\JobAds\Pages;

use App\Filament\Resources\JobAds\JobAdsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJobAds extends ViewRecord
{
    protected static string $resource = JobAdsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
