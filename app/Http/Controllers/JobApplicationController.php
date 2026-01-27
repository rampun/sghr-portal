<?php

namespace App\Http\Controllers;

use App\Enums\Users\UserRoleEnum;
use App\Enums\Users\UserStatusEnum;
use App\Mail\JobApplied;
use App\Models\JobAds;
use App\Models\JobApplication;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            $jobApplication = new JobApplication;
            $jobApplication->user_id = $request->user_id;
            $jobApplication->job_ad_id = $request->job_ad_id;
            $jobApplication->status = $request->status;
            $jobApplication->save();

            DB::commit();

            // job instance
            $job = JobAds::where('id', $request->job_ad_id)->first();
            // send email to candidate
            $emailReceipientJobSeeker = User::find($request->user_id);
            Mail::to($emailReceipientJobSeeker->email)
                ->send(new JobApplied($jobApplication, 'Job Application successful', 'mail.jobs.job_applied_applicant_template'));

            // send email to HR admins
            $hrAdminRecipient = User::where('role', UserRoleEnum::HR_ADMIN)
                ->where('status', UserStatusEnum::ACTIVE)
                ->get();
            foreach ($hrAdminRecipient as $user) {
                try {
                    Mail::to($user->email)
                        ->send(new JobApplied($jobApplication, 'New Job Application Received', 'mail.jobs.job_applied_hr_template'));

                    Log::info('Successfully sent to: ' . $user->email);
                } catch (\Exception $e) {
                    Log::error('Failed to send to ' . $user->email, [
                        'error' => $e->getMessage(),
                    ]);
                }
            }

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
