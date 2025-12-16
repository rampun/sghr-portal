@extends('layouts.app')

@section('title', 'Job list')

@section('content')
<div class="breadcrumbs text-sm">
    <ul>
        <li><a href="/">Home</a></li>
        <li>Jobs</li>
    </ul>
</div>

<div class="grid grid-cols-12 gap-8 mt-8">
    <!-- filter -->
    <div class="col-span-4 card w-full card-md flex flex-col gap-10">
        <!-- Job Type -->
        <div class="card-body shadow-md rounded-md job_type">
            <!-- Job type -->
            <div>
                <h3 class="text-md font-bold mb-2">
                    Job type
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach (App\Enums\Jobs\TypeEnum::cases() as $type)
                    <label class="label text-gray-600">
                        <input type="checkbox" name="{{ $type->value }}" class="checkbox checkbox-primary checkbox-sm" />
                        <span class="">{{ $type->getLabel() }}</span>
                    </label>
                    @endforeach
                </div>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>
            </div>
            <!-- Experience -->
            <div>
                <h3 class="text-md font-bold mb-2">
                    Experience Level
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach (App\Enums\Users\ExperienceLevelEnum::cases() as $experienceLevel)
                    <label class="label text-gray-600">
                        <input type="checkbox" name="{{ $experienceLevel->value }}" class="checkbox checkbox-primary checkbox-sm" />
                        <span class="">{{ $experienceLevel->getLabel() }}</span>
                    </label>
                    @endforeach
                </div>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>
            </div>

            <!-- Salary -->
            <div>
                <h3 class="text-md font-bold mb-2">
                    Salary(in USD per month)
                </h3>
                <div class="flex gap-2 justify-between">
                    <fieldset class="fieldset">
                        <input type="number" class="input input-sm text-gray-600 bg-gray-50 w-[120px] border-gray-600" placeholder="Min." />
                    </fieldset>
                    <fieldset class="fieldset">
                        <input type="number" class="input input-sm text-gray-600 bg-gray-50 w-[120px] border-gray-600" placeholder="Max." />
                    </fieldset>
                </div>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>
            </div>

            <!-- Remote type -->
            <div>
                <h3 class="text-md font-bold mb-2">
                    Remote option
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach (App\Enums\Jobs\LocationEnum::cases() as $location)
                    <label class="label text-gray-600">
                        <input type="checkbox" name="{{ $location->value }}" class="checkbox checkbox-primary checkbox-sm" />
                        <span class="">{{ $location->getLabel() }}</span>
                    </label>
                    @endforeach
                </div>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>
            </div>

            <!-- Location -->
            <div>
                <h3 class="text-md font-bold mb-2">
                    Location
                </h3>
                <div class="flex flex-col gap-2">
                    @foreach (App\Enums\Users\CountryEnum::cases() as $country)
                    <label class="label text-gray-600">
                        <input type="checkbox" name="{{ $country->value }}" class="checkbox checkbox-primary checkbox-sm" />
                        <span class="">{{ $country->getLabel() }}</span>
                    </label>
                    @endforeach
                </div>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- filtered job list -->
    <div class="col-span-8">
        <div class="flex text-black justify-between">
            <p class="text-normal"> 1-20 of 300 jobs</p>
            <p class="text-normal">Sort by</p>
        </div>

        <div class="card w-full card-md flex flex-col gap-10">
            @foreach($jobs as $job)
            <a href="{{ route('jobs.show', ['id' => $job->id]) }}" style="text-decoration: none; color: inherit;">
                <div class="card-body shadow-md rounded-md hover:shadow-xl hover:cursor-pointer transition-all duration-300">
                    <div class="grid grid-cols-12 gap-4 mb-1">
                        <div class="col-span-1">
                            <figure>
                                <x-cloudinary::image
                                    public-id="{{ $job->employer->logo_url }}"
                                    width="48"
                                    height="48"
                                    crop="fit"
                                    alt="{{ $job->employer->company_title }} logo" />
                            </figure>
                        </div>
                        <div class="col-span-7">
                            <h2 class="card-title">{{ $job->title }}</h2>
                            <div class="flex gap-4">
                                <span class="company text-gray-600">{{ $job->employer->company_name }}</span>
                                <p class="location flex items-center gap-1">
                                    <span class="text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>


                                    </span>
                                    <span class="text-gray-600">{{ App\Enums\Users\CountryEnum::from($job->country)->getLabel() }}</span>
                            </div>
                        </div>
                        <div class="col-span-4 text-right">
                            <p class="font-bold">
                                ${{ number_format($job->salary_min_range)}}-${{ number_format($job->salary_max_range) }} (USD/month)
                            </p>
                        </div>
                    </div>
                    <div class="grid mb-1">
                        <p class="line-clamp-3 text-normal">
                            {{ strip_tags($job->description) }}
                        </p>
                    </div>
                    <div class="flex gap-2 justify-start mb-1">
                        @foreach($job->required_skills as $required_skill)
                        <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">{{ $required_skill }}</div>
                        @endforeach
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="text-gray-600">
                            <p>Posted on: {{ date_format($job->created_at, 'Y-m-d') }}</p>
                        </div>
                        <div class="">
                            <p class="flex text-right gap-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                                <span>
                                    Save
                                </span>
                            </p>


                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <!-- <div class="pagination">
            <div class="join">
                <button class="join-item btn">1</button>
                <button class="join-item btn btn-active">2</button>
                <button class="join-item btn">3</button>
                <button class="join-item btn">4</button>
            </div>
        </div> -->
    </div>
</div>

@endsection