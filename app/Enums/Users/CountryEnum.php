<?php

namespace App\Enums\Users;

use Filament\Support\Contracts\HasLabel;

enum CountryEnum: string implements HasLabel
{
    case HK = 'HK';
    case NP = 'NP';
    case AE = 'AE';
    case IN = 'IN';

    public function getLabel(): string
    {
        return match ($this) {
            self::HK => 'Hong Kong',
            self::NP => 'Nepal',
            self::AE => 'United Arab Emirates',
            self::IN => 'India',
        };
    }
}
