<?php

namespace App\Enums\Users;

use Filament\Support\Contracts\HasLabel;

enum IndustryEnum: string implements HasLabel
{
    case TECHNOLOGY = 'TECHNOLOGY';
    case FINANCE = 'FINANCE';
    case HEALTHCARE = 'HEALTHCARE';
    case EDUCATION = 'EDUCATION';
    case MANUFACTURING = 'MANUFACTURING';
    case RETAIL = 'RETAIL';
    case HOSPITALITY = 'HOSPITALITY';
    case CONSTRUCTION = 'CONSTRUCTION';
    case TRANSPORTATION = 'TRANSPORTATION';
    case ENERGY = 'ENERGY';

    public function getLabel(): string
    {
        return match ($this) {
            self::TECHNOLOGY => 'Technology',
            self::FINANCE => 'Finance',
            self::HEALTHCARE => 'Healthcare',
            self::EDUCATION => 'Education',
            self::MANUFACTURING => 'Manufacturing',
            self::RETAIL => 'Retail',
            self::HOSPITALITY => 'Hospitality',
            self::CONSTRUCTION => 'Construction',
            self::TRANSPORTATION => 'Transportation',
            self::ENERGY => 'Energy',
        };
    }
}
