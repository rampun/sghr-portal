<?php

namespace App\Enum;

enum UserRole: int
{
    case CANDIDATE = 1;
    case EMPLOYER = 2;
    case HR_ADMIN = 3;
    case SUPER_ADMIN = 4;
}
