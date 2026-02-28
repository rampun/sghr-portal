<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Users\CompanySizeEnum;
use App\Enums\Users\CountryEnum;
use App\Enums\Users\EducationLevelEnum;
use App\Enums\Users\ExperienceLevelEnum;
use App\Enums\Users\IndustryEnum;
use App\Enums\Users\UserRoleEnum;
use App\Enums\Users\UserStatusEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasAvatar, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, Notifiable, SoftDeletes;

    public $incrementing = false; // Disable auto-incrementing

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'avatar_url',
        'status',
        'company_name',
        'company_size',
        'company_website',
        'company_description',
        'company_industry',
        'company_country',
        'logo_url',
        'resume_url',
        'experience_level',
        'current_position',
        'current_company',
        'education_level',
        'total_exeperience_years',
        'expected_salary',
        'user_country',
        'user_industry',
        'user_skills',
        'admin_level',
        'admin_notes',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_skills' => 'array',
        'resume_url' => 'string',
        'logo_url' => 'string',
        'status' => UserStatusEnum::class,
        'role' => UserRoleEnum::class,
        'education_level' => EducationLevelEnum::class,
        'experience_level' => ExperienceLevelEnum::class,
        'company_size' => CompanySizeEnum::class,
        'company_industry' => IndustryEnum::class,
        'user_industry' => IndustryEnum::class,
        'user_country' => CountryEnum::class,
        'company_country' => CountryEnum::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function jobs()
    {
        return $this->hasMany(JobAds::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // check admin panel
        if ($panel->getId() === 'admin') {
            return $this->role === UserRoleEnum::HR_ADMIN;
        }

        if ($panel->getId() === 'employer') {
            return $this->role === UserRoleEnum::EMPLOYER;
        }

        if ($panel->getId() === 'jobseeker') {
            return $this->role === UserRoleEnum::JOB_SEEKER;
        }

        return false;
    }

    // Add this method to your User model
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmail);
    }

    // filament avatar
    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar_url) {
            return 'https://res.cloudinary.com/'.env('CLOUDINARY_CLOUD_NAME').'/image/upload/v1770825653/'.$this->avatar_url;
        }

        return null;
    }

    // Check if user is a job seeker
    public function isJobSeeker(): bool
    {
        return $this->role === UserRoleEnum::JOB_SEEKER;
    }

    // Check if user is an employer
    public function isEmployer(): bool
    {
        return $this->role === UserRoleEnum::EMPLOYER;
    }

    // Check if user is admin
    public function isAdmin(): bool
    {
        return $this->role === UserRoleEnum::HR_ADMIN;
    }
}
