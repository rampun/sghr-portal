<?php

namespace App\Http\Controllers;

use App\Enums\Jobs\StatusEnum;
use App\Models\JobAds;
use App\Models\JobApplication;
use App\Models\SavedJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth Facade

class JobsController extends Controller
{
    public function index(Request $request)
    {
        $jobs = JobAds::where('status', StatusEnum::ACTIVE->value)->paginate(20);

        return view('pages.jobs.index', ['jobs' => $jobs]);
    }

    public function show(Request $request)
    {
        $jobId = $request->id;
        $job = JobAds::find($jobId);
        // recommended jobs
        $recommendedJobs = JobAds::where('industry', $job->industry)
            ->where('status', StatusEnum::ACTIVE->value)
            ->where('id', '<>', $job->id)
            ->take(5)
            ->get();
        // is job applied
        $isJobApplied = JobApplication::where('user_id', Auth::id())
            ->where('job_ad_id', $jobId)->exists();
        $isSaved = SavedJobs::where('user_id', Auth::id())
            ->where('job_ad_id', $jobId)->exists();
        $noOfApplicants = JobApplication::where('job_ad_id', $jobId)->count();

        return view('pages.jobs.single', compact('job', 'recommendedJobs', 'isJobApplied', 'isSaved', 'noOfApplicants'));
    }
}
