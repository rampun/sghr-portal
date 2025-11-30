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
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\JobAds;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids, SoftDeletes;

    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
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
        'admin_notes'
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'user_skills' => 'array',
            'status' => UserStatusEnum::class,
            'role' => UserRoleEnum::class,
            'education_level' => EducationLevelEnum::class,
            'experience_level' => ExperienceLevelEnum::class,
            'company_size' => CompanySizeEnum::class,
            'company_industry' => IndustryEnum::class,
            'user_industry' => IndustryEnum::class,
            'user_country' => CountryEnum::class,
            'company_country' => CountryEnum::class,
        ];
    }

    public function getNameAttribute(): string
    {
        // Example: If you have first_name and last_name
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        // Example: If you have a 'username' field instead of 'name'
        return $this->username ?? ''; // Return username or an empty string if null
    }

    public function jobs()
    {
        return $this->hasMany(JobAds::class);
    }
}
