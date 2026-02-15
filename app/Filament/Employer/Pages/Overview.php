<?php

namespace App\Filament\Employer\Pages;

use App\Enums\Users\UserRoleEnum;
use App\Enums\Users\UserStatusEnum;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Overview extends Page
{
    protected string $view = 'filament.employer.pages.overview';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $recordTitleAttribute = 'Overview';

    protected static ?string $navigationLabel = 'Overview';

    public array $jobSeekerByCountry = [];

    public array $jobSeekerByIndustry = [];

    public array $jobSeekerByExperience = [];

    public function mount(): void
    {
        $jobSeekerByCountry = User::selectRaw('user_country, COUNT(*) as count')
            ->where('role', UserRoleEnum::JOB_SEEKER->value)
            ->where('status', UserStatusEnum::ACTIVE->value)
            ->groupBy('user_country')
            ->pluck('count', 'user_country')
            ->toArray();
        $this->jobSeekerByCountry = $jobSeekerByCountry;

        $jobSeekerByIndustry = User::selectRaw('user_industry, COUNT(*) as count')
            ->where('role', UserRoleEnum::JOB_SEEKER->value)
            ->where('status', UserStatusEnum::ACTIVE->value)
            ->groupBy('user_industry')
            ->pluck('count', 'user_industry')
            ->toArray();
        $this->jobSeekerByIndustry = $jobSeekerByIndustry;

        $jobSeekerByExperience = User::selectRaw('experience_level, COUNT(*) as count')
            ->where('role', UserRoleEnum::JOB_SEEKER->value)
            ->where('status', UserStatusEnum::ACTIVE->value)
            ->groupBy('experience_level')
            ->pluck('count', 'experience_level')
            ->toArray();
        $this->jobSeekerByExperience = $jobSeekerByExperience;
    }
}
