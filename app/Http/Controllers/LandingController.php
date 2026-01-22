<?php

namespace App\Http\Controllers;

use App\Enums\Jobs\StatusEnum;
use App\Models\JobAds;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {

        // get random jobs for initial load
        $recommendedJobs = JobAds::where('status', StatusEnum::ACTIVE->value)
            ->inRandomOrder()
            ->get()
            ->take(4);


        return view('pages.landing.index', [
            'recommendedJobs' => $recommendedJobs,
        ]);
    }
}
