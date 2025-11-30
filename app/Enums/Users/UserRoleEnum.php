<?php

namespace App\Enums\Users;

use Filament\Support\Contracts\HasLabel;

enum UserRoleEnum: string implements HasLabel

{
    case JOB_SEEKER = "JOB_SEEKER";
    case EMPLOYER = "EMPLOYER";
    case HR_ADMIN = "HR_ADMIN";

    public function getLabel(): string
    {
        return match ($this) {
            self::JOB_SEEKER => 'Job Seeker',
            self::EMPLOYER => 'Employer',
            self::HR_ADMIN => 'HR Admin',
        };
    }
}
