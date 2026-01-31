<?php

namespace App\Filament\Employer\Resources\JobAds\Pages;

use App\Filament\Employer\Resources\JobAds\JobAdsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJobAds extends ListRecords
{
    protected static string $resource = JobAdsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
