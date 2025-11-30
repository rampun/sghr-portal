<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CompanySizeEnum: string implements HasLabel
{
    case SMALL = 'SMALL';
    case MEDIUM = 'MEDIUM';
    case LARGE = 'LARGE';
    public function getLabel(): string
    {
        return match ($this) {
            self::SMALL => 'Small (1-20 employees)',
            self::MEDIUM => 'Medium (21-50 employees)',
            self::LARGE => 'Large (50+ employees)',
        };
    }
}
