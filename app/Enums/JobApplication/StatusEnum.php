<?php

namespace App\Enums\JobApplication;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasColor, HasLabel
{
    case PENDING = 'PENDING';
    case REVIEWED = 'REVIEWED';
    case SHORTLISTED = 'SHORTLISTED';
    case REJECTED = 'REJECTED';
    case ACCEPTED = 'ACCEPTED';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::REVIEWED => 'Reviewed',
            self::SHORTLISTED => 'Shortlisted',
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
            self::REJECTED => 'danger',
            self::ACCEPTED => 'success',
        };
    }
}
