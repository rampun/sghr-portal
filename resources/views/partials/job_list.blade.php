@if($jobs->count() > 0)
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
                <!-- <div class="">
                            <p class="flex text-right gap-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                                <span>
                                    Save
                                </span>
                            </p>
                        </div> -->
            </div>
        </div>
    </a>
    @endforeach
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $jobs->withQueryString()->links() }}
</div>
@else
<div class="text-center py-12">
    <h3 class="text-xl font-semibold text-gray-700">No jobs found</h3>
    <p class="text-gray-500 mt-2">Try adjusting your filters</p>
</div>
@endif