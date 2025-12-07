<?php

namespace App\Enums\JobApplication;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel, HasColor
{
    case PENDING = 'PENDING';
    case REVIEWED = 'REVIEWED';
    case SHORTLISTED = 'SHORTLISTED';
    case INTERVIEWING = 'INTERVIEWING';
    case REJECTED = 'REJECTED';
    case ACCEPTED = 'ACCEPTED';
    case WITHDRAWN = 'WITHDRAWN';
    case ARCHIVED = 'ARCHIVED';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::REVIEWED => 'Reviewed',
            self::SHORTLISTED => 'Shortlisted',
            self::INTERVIEWING => 'Interviewing',
            self::REJECTED => 'Rejected',
            self::ACCEPTED => 'Accepted',
            self::WITHDRAWN => 'Withdrawn',
            self::ARCHIVED => 'Archived',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'gray',
            self::REVIEWED => 'blue',
            self::SHORTLISTED => 'green',
            self::INTERVIEWING => 'purple',
            self::REJECTED => 'red',
            self::ACCEPTED => 'dark-green',
            self::WITHDRAWN => 'orange',
            self::ARCHIVED => 'light-gray',
        };
    }
}
