<?php

namespace App\Filament\Employer\Resources\Users\Pages;

use App\Filament\Employer\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
