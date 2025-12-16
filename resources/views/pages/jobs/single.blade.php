@extends('layouts.app')

@section('title', 'Job list')

@section('content')
<div class="breadcrumbs text-sm">
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/jobs">Jobs</a></li>
        <li>{{ $job->title }}</li>
    </ul>
</div>

<div class="grid grid-cols-12 gap-8 mt-8">
    <div class="col-span-8">
        <div class="card shadow-md">
            <div class="card-body">
                <div class="header">
                    <div class="flex justify-between">
                        <div class="content">
                            <h2 class="card-title">{{ $job->title }}</h2>
                            <p class="text-gray-600 mt-1">{{ $job->employer->company_name }}</p>
                            <div class="highlights flex flex-col gap-1 mt-2">
                                <div class="flex text-gray-600 items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    <span>{{ App\Enums\Users\ExperienceLevelEnum::from($job->experience->value)->getLabel() }}</span>
                                </div>
                                <div class="flex text-gray-600 items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span>${{ number_format($job->salary_min_range)}}-${{ number_format($job->salary_max_range) }} (USD/month)</span>
                                </div>
                                <div class="flex text-gray-600 items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <span>{{ App\Enums\Users\CountryEnum::from($job->country)->getLabel() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="logo">
                            <figure>
                                <x-cloudinary::image
                                    public-id="{{ $job->employer->logo_url }}"
                                    width="48"
                                    height="48"
                                    crop="fit"
                                    alt="{{ $job->employer->company_title }} logo" />
                            </figure>
                        </div>
                    </div>
                    <div class="flex w-full flex-col">
                        <div class="divider bg-gray-200 h-[1px]"></div>
                    </div>
                    <div class="meta flex gap-6 justify-between items-center">
                        <div class="flex gap-2">
                            <p class="flex gap-1 items-center">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                                </svg> -->
                                <span>Posted:</span>
                                <span>
                                    {{ date_format($job->created_at, 'Y-m-d') }}
                                </span>
                            </p>|
                            <p class="flex gap-1 items-center">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                    <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                </svg> -->
                                <span>
                                    Openings:
                                </span>
                                <span>
                                    {{ $job->no_of_employee }}
                                </span>
                            </p>|
                            <p class="flex gap-1 items-center">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                </svg> -->
                                <span>
                                    Applicants:
                                </span>
                                <span>
                                    {{ $noOfApplicants }}
                                </span>
                            </p>
                        </div>
                        <div class="register_login flex gap-2 items-center">
                            @if (auth()->user())
                            @if($isSaved)
                            <form action="{{ route('saved-jobs.destroy') }}" method="POST">
                                @csrf <!-- Laravel CSRF token -->
                                @method('DELETE') <!-- Spoof the DELETE method -->
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="job_ad_id" value="{{ $job->id }}">
                                <button type="submit" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 fill-indigo-500">
                                        <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('saved-jobs.store') }}" method="POST">
                                @csrf <!-- Laravel CSRF token -->
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="job_ad_id" value="{{ $job->id }}">
                                <button type="submit" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-indigo-500 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                            @else
                            <!-- need login -->
                            <button type="submit" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 fill-indigo-500">
                                    <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            @endif

                            @if (auth()->user())
                            <form action="{{ route('job-applications.store') }}" method="POST">
                                @csrf <!-- Laravel CSRF token -->
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="job_ad_id" value="{{ $job->id }}">
                                <input type="hidden" name="status" value="PENDING">

                                @if($isJobApplied)
                                <button class="py-2 px-4 rounded-3xl font-bold
                disabled:text-gray-400 disabled:bg-gray-300 disabled:cursor-not-allowed"
                                    disabled>
                                    Applied
                                </button>
                                @else
                                <button
                                    type="submit"
                                    class="btn btn-primary text-white rounded-3xl bg-indigo-500">
                                    Apply
                                </button>
                                @endif
                            </form>
                            @else
                            <a class="btn btn-outline btn-primary rounded-3xl">Register to apply</a>
                            <a class="btn btn-primary text-white rounded-3xl bg-indigo-500" href="/jobseeker">Login to appy</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-[30px]"></div>
        <div class="card shadow-md">
            <div class="card-body">
                <div class="job_description">
                    {!! $job->description !!}
                </div>
                <div class="job_meta">
                    <ul>
                        <li><b>Industry:</b> <span>{{ App\Enums\Users\IndustryEnum::from($job->industry->value)->getLabel() }}</span></li>
                        <li><b>Employment Type:</b> <span>{{ App\Enums\Jobs\TypeEnum::from($job->type->value)->getLabel() }}</span></li>
                        <!-- <li><b>Education:</b><span> N/A</span></li> -->
                    </ul>
                </div>
                <div class="keyskill">
                    <h3 class="text-md font-bold">Key Skills</h3>
                    <div class="flex gap-2 justify-start mt-2">
                        @foreach($job->required_skills as $required_skill)
                        <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">{{ $required_skill }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>
                <div>
                    <h3 class="text-md font-bold">
                        Share this job
                    </h3>
                </div>
                <div class="social_share flex gap-2">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="32" height="32" viewBox="0 0 48 48">
                            <path fill="#3F51B5" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z"></path>
                            <path fill="#FFF" d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z"></path>
                        </svg>
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="32" height="32" viewBox="0 0 48 48">
                            <path fill="#0288D1" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z"></path>
                            <path fill="#FFF" d="M12 19H17V36H12zM14.485 17h-.028C12.965 17 12 15.888 12 14.499 12 13.08 12.995 12 14.514 12c1.521 0 2.458 1.08 2.486 2.499C17 15.887 16.035 17 14.485 17zM36 36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698-1.501 0-2.313 1.012-2.707 1.99C24.957 25.543 25 26.511 25 27v9h-5V19h5v2.616C25.721 20.5 26.85 19 29.738 19c3.578 0 6.261 2.25 6.261 7.274L36 36 36 36z"></path>
                        </svg>
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28" height="28" viewBox="0 0 48 48">
                            <path d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="h-[30px]"></div>
        <div class="card shadow-md">
            <div class="card-body">
                <div class="header">
                    <div class="">
                        <div class="">
                            <div>
                                <h2 class="text-md font-bold">About company</h2>
                                <p class="text-gray-600 mt-1 font-bold">{{ $job->employer->company_name }}</p>
                                <p class="text-gray-600 mt-1">{{ $job->employer->company_description }}</p>
                            </div>
                            <div class="flex w-full flex-col">
                                <div class="divider bg-gray-200 h-[1px]"></div>
                            </div>
                            <div>
                                <h2 class="text-md font-bold">Company Info</h2>
                                <p><b>Website:</b> {{ $job->employer->website ?? 'N/A'}} </p>
                                <p><b>Size:</b> {{ App\Enums\Users\CompanySizeEnum::from($job->employer->company_size->value)->getLabel() }} </p>
                                <p><b>Inudstry:</b> {{ App\Enums\Users\IndustryEnum::from($job->industry->value)->getLabel() }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-4 card shadow-md">
        <div class="card-body">
            <div class="header">
                <h2 class="text-lg font-bold">Recommended Jobs</h2>

                <!-- Recomended jobs -->
                @if($recommendedJobs->count())
                @foreach($recommendedJobs as $recommendedJob)
                <a href="{{ route('jobs.show', ['id' => $recommendedJob->id]) }}" style="text-decoration: none; color: inherit;">
                    <div class="flex justify-between gap-4 mt-4 mb-4">
                        <div class="job_content">
                            <h3 class="text-normal font-bold mb-1">{{ $recommendedJob->title }}</h3>
                            <p class="mb-2">{{ $recommendedJob->employer->company_name }}</p>
                            <div class="flex text-gray-600 items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>${{ number_format($job->salary_min_range)}}-${{ number_format($job->salary_max_range) }} (USD/month)</span>
                            </div>
                            <div class="flex text-gray-600 items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <span>{{ App\Enums\Users\CountryEnum::from($recommendedJob->country)->getLabel() }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>
                @endforeach
                @else
                <div>
                    <p>No recommended jobs</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection