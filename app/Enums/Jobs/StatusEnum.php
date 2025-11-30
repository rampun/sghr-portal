<?php

namespace App\Enums\Jobs;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel, HasColor
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case FILLED = 'FILLED';
    case EXPIRED = 'EXPIRED';

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::FILLED => 'Filled',
            self::EXPIRED => 'Expired',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'secondary',
            self::FILLED => 'warning',
            self::EXPIRED => 'danger',
        };
    }
}
