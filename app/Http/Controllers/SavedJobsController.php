<?php

namespace App\Http\Controllers;

use App\Models\SavedJobs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavedJobsController extends Controller
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
            $savedJobs = new SavedJobs();
            $savedJobs->user_id = $request->user_id;
            $savedJobs->job_ad_id = $request->job_ad_id;
            $savedJobs->save();
            DB::commit();
            return redirect()->route('jobs.show', $request->job_ad_id);
        } catch (Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SavedJobs $savedJobs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SavedJobs $savedJobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SavedJobs $savedJobs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            SavedJobs::where('user_id', $request->user_id)
                ->where('job_ad_id', $request->job_ad_id)
                ->delete();
            DB::commit();
            return redirect()->route('jobs.show', $request->job_ad_id);
        } catch (Exception $exception) {
            DB::rollBack();
        }
    }
}
