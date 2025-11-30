<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum EducationLevelEnum: string implements HasLabel
{
    case HIGH_SCHOOL = 'HIGH_SCHOOL';
    case ASSOCIATE_DEGREE = 'ASSOCIATE_DEGREE';
    case BACHELOR_DEGREE = 'BACHELOR_DEGREE';
    case MASTER_DEGREE = 'MASTER_DEGREE';
    case DOCTORATE = 'DOCTORATE';

    public function getLabel(): string
    {
        return match ($this) {
            self::HIGH_SCHOOL => 'High School Diploma',
            self::ASSOCIATE_DEGREE => 'Associate Degree',
            self::BACHELOR_DEGREE => 'Bachelor\'s Degree',
            self::MASTER_DEGREE => 'Master\'s Degree',
            self::DOCTORATE => 'Doctorate (PhD)',
        };
    }
}
