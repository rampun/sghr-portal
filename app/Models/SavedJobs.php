<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SavedJobs extends Model
{
    use HasUuids;

    public $incrementing = false; // Disable auto-incrementing

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'job_ad_id',
    ];

    public function jobseeker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job()
    {
        return $this->belongsTo(JobAds::class, 'job_ad_id');
    }
}
