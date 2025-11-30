<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CountryEnum: string implements HasLabel
{
    case IN = 'IN';
    case HK = 'HK';
    case AE = 'AE';
    case NP = 'NP';
    case SG = 'SG';
    case MO = 'MO';
    case PH = 'PH';
    case MY = 'MY';
    case QA = 'QA';
    case UK = 'UK';
    case AU = 'AU';

    public function getLabel(): string
    {
        return match ($this) {
            self::IN => 'India',
            self::HK => 'Hong Kong',
            self::AE => 'United Arab Emirates',
            self::NP => 'Nepal',
            self::SG => 'Singapore',
            self::MO => 'Macau',
            self::PH => 'Philippines',
            self::MY => 'Malaysia',
            self::QA => 'Qatar',
            self::UK => 'United Kingdom',
            self::AU => 'Australia',
        };
    }
}
