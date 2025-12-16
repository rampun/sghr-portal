<?php

namespace App\Filament\Resources\JobApplications\Schemas;

use App\Enums\JobApplication\StatusEnum;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class JobApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('status')
                    ->options(StatusEnum::class)
                    ->required(),
            ]);
    }
}
