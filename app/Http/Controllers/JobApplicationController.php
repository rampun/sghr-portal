<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $jobApplication = new JobApplication();
            $jobApplication->user_id = $request->user_id;
            $jobApplication->job_ad_id = $request->job_ad_id;
            $jobApplication->status = $request->status;
            $jobApplication->save();

            DB::commit();
            return redirect()->route('jobs.show', $request->job_ad_id);
        } catch (Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        //
    }
}
