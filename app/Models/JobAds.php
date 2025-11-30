<?php

namespace App\Models;

use App\Enums\Jobs\TypeEnum;
use App\Enums\Jobs\LocationEnum;
use App\Enums\Users\ExperienceLevelEnum;
use App\Enums\Users\IndustryEnum;
use App\Enums\Jobs\AdDurationEnum;
use App\Enums\Jobs\StatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class JobAds extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasUuids, SoftDeletes;

    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'type',
        'location',
        'experience',
        'industry',
        'duration',
        'salary_min_range',
        'salary_max_range',
        'status',
        'start_date',
    ];

    protected function casts()
    {
        return [
            'type' => TypeEnum::class,
            'location' => LocationEnum::class,
            'status' => StatusEnum::class,
            'experience' => ExperienceLevelEnum::class,
            'industry' => IndustryEnum::class,
            'duration' => AdDurationEnum::class,
        ];
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
