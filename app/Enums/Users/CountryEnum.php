<?php

namespace App\Enums\Users;

use Filament\Support\Contracts\HasLabel;

enum CountryEnum: string implements HasLabel
{
    case IN = 'IN';
    case HK = 'HK';
    case NP = 'NP';
    case MO = 'MO';
    case PH = 'PH';
    case MY = 'MY';
    case QA = 'QA';

    public function getLabel(): string
    {
        return match ($this) {
            self::IN => 'India',
            self::HK => 'Hong Kong',
            self::NP => 'Nepal',
            self::MO => 'Macau',
            self::PH => 'Philippines',
            self::MY => 'Malaysia',
            self::QA => 'Qatar'
        };
    }
}
