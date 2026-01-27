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
        $jobs = $this->getFilteredJobs($request);
        if ($request->wantsJson()) {
            try {
                return response()->json([
                    'success' => true,
                    'jobs' => view('partials.job_list', compact('jobs'))->render(),
                    'total_jobs' => $jobs->total(),
                    'filters' => $request->except('page'),
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error filtering jobs',
                ], 500);
            }
        }

        return view('pages.jobs.index', ['jobs' => $jobs]);
    }

    public function filter(Request $request)
    {
        try {
            $jobs = $this->getFilteredJobs($request);

            return response()->json([
                'success' => true,
                'jobs' => view('jobs.partials.job-list', compact('jobs'))->render(),
                'total_jobs' => $jobs->total(),
                'filters' => $request->except('page'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error filtering jobs',
            ], 500);
        }
    }

    private function getFilteredJobs(Request $request)
    {
        $query = JobAds::where('status', StatusEnum::ACTIVE->value);

        // Search keyword
        if ($request->has('s')) {
            $search = $request->get('s');
            $query->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('required_skills', 'LIKE', "%{$search}%")
                    ->orWhere('industry', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%");
            });
        }

        // job_type (checkbox/multiple)
        if ($request->has('job_type')) {
            $jobType = is_array($request->get('job_type'))
                ? $request->get('job_type')
                : explode(',', $request->get('job_type'));
            $query->whereIn('type', $jobType);
        }

        // experience (checkbox/multiple)
        if ($request->has('experience')) {
            $jobType = is_array($request->get('experience'))
                ? $request->get('experience')
                : explode(',', $request->get('experience'));
            $query->whereIn('experience', $jobType);
        }

        // Salary range filter (input boxes)
        if ($request->has('min_salary')) {
            $query->where('salary_min_range', '>=', $request->min_salary);
        }

        if ($request->has('max_salary')) {
            $query->where('salary_max_range', '<=', $request->max_salary);
        }

        // job_type (checkbox/multiple)
        if ($request->has('remote')) {
            $jobType = is_array($request->get('remote'))
                ? $request->get('remote')
                : explode(',', $request->get('remote'));
            $query->whereIn('location', $jobType);
        }

        // job_type (checkbox/multiple)
        if ($request->has('country')) {
            $jobType = is_array($request->get('country'))
                ? $request->get('country')
                : explode(',', $request->get('country'));
            $query->whereIn('country', $jobType);
        }

        // // Sort by
        // $sort = $request->get('sort', 'latest');
        // switch ($sort) {
        //     case 'salary_high':
        //         $query->orderBy('salary', 'desc');
        //         break;
        //     case 'salary_low':
        //         $query->orderBy('salary', 'asc');
        //         break;
        //     case 'oldest':
        //         $query->orderBy('created_at', 'asc');
        //         break;
        //     default: // latest
        //         $query->orderBy('created_at', 'desc');
        // }

        return $query->paginate(2);
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
