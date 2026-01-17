<?php

namespace App\Policies;

use App\Enums\Users\UserRoleEnum;
use App\Models\JobAds;
use App\Models\User;

class JobAdsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobAds $jobAds): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()?->role === UserRoleEnum::HR_ADMIN;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobAds $jobAds): bool
    {
        return auth()->user()?->role === UserRoleEnum::HR_ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobAds $jobAds): bool
    {
        return auth()->user()?->role === UserRoleEnum::HR_ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JobAds $jobAds): bool
    {
        return auth()->user()?->role === UserRoleEnum::HR_ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JobAds $jobAds): bool
    {
        return auth()->user()?->role === UserRoleEnum::HR_ADMIN;
    }
}
