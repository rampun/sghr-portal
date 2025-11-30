<?php

namespace App\Enums\Jobs;

use Filament\Support\Contracts\HasLabel;

enum LocationEnum: string implements HasLabel
{
    case REMOTE = 'REMOTE';
    case ONSITE = 'ONSITE';
    case HYBRID = 'HYBRID';

    public function getLabel(): string
    {
        return match ($this) {
            self::REMOTE => 'Remote',
            self::ONSITE => 'Onsite',
            self::HYBRID => 'Hybrid',
        };
    }
}
