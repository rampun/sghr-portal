<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AdminLevelEnum: string implements HasLabel
{
    case HR_ADMIN = 'HR_ADMIN';
    case SUPER_ADMIN = 'SUPER_ADMIN';

    public function getLabel(): string
    {
        return match ($this) {
            self::HR_ADMIN => 'HR Admin',
            self::SUPER_ADMIN => 'Super Admin',
        };
    }
}
