<?php

namespace App\Http\Controllers;

use App\Enums\Jobs\StatusEnum;
use App\Models\JobAds;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index(Request $request)
    {
        $jobs = JobAds::where('status', StatusEnum::ACTIVE->value)->paginate(20);
        return view('pages.jobs.index', ['jobs' => $jobs]);
    }
    public function show(Request $request)
    {
        $job = JobAds::find($request->id);
        return view('pages.jobs.single', ['job' => $job]);
    }
}
