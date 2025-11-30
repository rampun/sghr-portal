<?php

namespace App\Enums\Jobs;

use Filament\Support\Contracts\HasLabel;

enum TypeEnum: string implements HasLabel
{
    case FULL_TIME = 'FULL_TIME';
    case PART_TIME = 'PART_TIME';
    case CONTRACT = 'CONTRACT';
    case INTERNSHIP = 'INTERNSHIP';

    public function getLabel(): string
    {
        return match ($this) {
            self::FULL_TIME => 'Full Time',
            self::PART_TIME => 'Part Time',
            self::CONTRACT => 'Contract',
            self::INTERNSHIP => 'Internship',
        };
    }
}
