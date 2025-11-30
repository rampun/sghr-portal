<?php

namespace App\Enums\Jobs;

use Filament\Support\Contracts\HasLabel;

enum AdDurationEnum: string implements HasLabel
{
    case ONE_WEEK = 'ONE_WEEK';
    case TWO_WEEKS = 'TWO_WEEKS';
    case ONE_MONTH = 'ONE_MONTH';
    case THREE_MONTHS = 'THREE_MONTHS';

    public function getLabel(): string
    {
        return match ($this) {
            self::ONE_WEEK => '1 Week',
            self::TWO_WEEKS => '2 Weeks',
            self::ONE_MONTH => '1 Month',
            self::THREE_MONTHS => '3 Months',
        };
    }
}
