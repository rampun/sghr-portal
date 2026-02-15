<?php

namespace App\Enums\JobApplication;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasColor, HasLabel
{
    case PENDING = 'PENDING';
    case REVIEWED = 'REVIEWED';
    case SHORTLISTED = 'SHORTLISTED';
    case INTERVIEW_SCHEDULED = 'INTERVIEW_SCHEDULED';
    case REJECTED = 'REJECTED';
    case ACCEPTED = 'ACCEPTED';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::REVIEWED => 'Reviewed',
            self::SHORTLISTED => 'Shortlisted',
            self::INTERVIEW_SCHEDULED => 'Interview Scheduled',
            self::REJECTED => 'Rejected',
            self::ACCEPTED => 'Accepted',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'gray',
            self::REVIEWED => 'warning',
            self::SHORTLISTED => 'warning',
            self::INTERVIEW_SCHEDULED => 'primary',
            self::REJECTED => 'danger',
            self::ACCEPTED => 'success',
        };
    }
}
