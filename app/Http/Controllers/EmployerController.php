<?php

namespace App\Http\Controllers;

use App\Enums\Jobs\StatusEnum;
use App\Enums\Users\UserRoleEnum;
use App\Enums\Users\UserStatusEnum;
use App\Models\JobAds;
use App\Models\User;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employers = User::where('role', UserRoleEnum::EMPLOYER->value)
            ->where('status', UserStatusEnum::ACTIVE->value)
            ->paginate(5);

        return view('pages.employers.index', compact('employers'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobs = JobAds::where('user_id', $id)
            ->where('status', StatusEnum::ACTIVE->value)
            ->paginate(10);
        $employer = User::where('id', $id)
            ->where('role', UserRoleEnum::EMPLOYER->value)
            ->where('status', UserStatusEnum::ACTIVE->value)
            ->firstOrFail();

        return view('pages.employers.single', compact('employer', 'jobs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
