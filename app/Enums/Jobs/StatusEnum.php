<?php

namespace App\Enums\Jobs;

use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case FILLED = 'FILLED';

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::FILLED => 'Filled',
        };
    }
}
