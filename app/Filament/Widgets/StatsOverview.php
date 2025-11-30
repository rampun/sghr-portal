<?php

namespace App\Filament\Widgets;

use App\Enums\Users\UserRoleEnum;
use App\Enums\Users\UserStatusEnum;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Job Seeker', User::where('role', UserRoleEnum::JOB_SEEKER)->where('status', UserStatusEnum::ACTIVE)->count()),
            Stat::make('Employer',  User::where('role', UserRoleEnum::EMPLOYER)->where('status', UserStatusEnum::ACTIVE)->count()),
            Stat::make('Admin',  User::where('role', UserRoleEnum::HR_ADMIN)->where('status', UserStatusEnum::ACTIVE)->count()),
            // Stat::make('Bounce rate', '21%')
            //     ->description('7% increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-down')
            //     ->color('danger'),
            // Stat::make('Average time on page', '3:12')
            //     ->description('3% increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->color('success'),
            // Stat::make('Unique views', '192.1k')
            //     ->description('32k increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)
        ];
    }
}
