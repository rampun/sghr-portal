<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ExperienceLevelEnum: string implements HasLabel
{
    case ENTRY_LEVEL = 'ENTRY_LEVEL';
    case MID_LEVEL = 'MID_LEVEL';
    case SENIOR_LEVEL = 'SENIOR_LEVEL';
    case MANAGEMENT = 'MANAGEMENT';
    case EXECUTIVE = 'EXECUTIVE';

    public function getLabel(): string
    {
        return match ($this) {
            self::ENTRY_LEVEL => 'Entry Level (0-2 years)',
            self::MID_LEVEL => 'Mid Level (3-5 years)',
            self::SENIOR_LEVEL => 'Senior Level (6-10 years)',
            self::MANAGEMENT => 'Management (10+ years)',
            self::EXECUTIVE => 'Executive (15+ years)',
        };
    }
}
