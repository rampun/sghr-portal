<?php

namespace App\Models;

use App\Enums\JobApplication\StatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasUuids;

    public $incrementing = false; // Disable auto-incrementing

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'job_ad_id',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
        ];
    }

    public function jobseeker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job()
    {
        return $this->belongsTo(JobAds::class, 'job_ad_id');
    }
}
