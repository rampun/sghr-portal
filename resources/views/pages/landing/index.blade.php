    @extends('layouts.app')

    @section('title', 'Home Page')

    @section('content')

    <div class="text-center mt-6">
        <h1 class="text-black text-4xl text-center font-bold mb-3">Find your dream job now</h1>
        <p>Explore jobs and apply for your dream job! </p>
    </div>
    <div class="search_jobs mt-16 join flex justify-center gap-0">
        <form method="GET" action="{{ route('jobs.index') }}">
            <label class="input validator join-item bg-white border-1  border-neutral-300 w-[650px] h-[48px]">
                <input type="text" name="s" class="bg-white shadow-2xs " placeholder="Search jobs, skills, industry" value="<?= htmlspecialchars($_GET['s'] ?? '') ?>" required />
            </label>
            <button class="btn shadow:none btn-neutral join-item h-[48px]">Search</button>
        </form>
    </div>

    <div class="banner flex justify-center gap-0 mt-16 text-2xl font-semibold">
        <span>
            We don't just place talent, we unlock
            <span class="text-rotate">
                <span>
                    <span class="uppercase bg-teal-400 text-teal-800 px-2">potential</span>
                    <span class="uppercase bg-red-400 text-red-800 px-2">careers</span>
                    <span class="uppercase bg-blue-400 text-blue-800 px-2">innovation</span>
                    <span class="uppercase bg-yellow-400 text-yellow-800 px-2">teams</span>
                    <span class="uppercase bg-rose-400 text-rose-800 px-2">futures</span>
                </span>
            </span>
        </span>
    </div>

    <!-- CTA job search section -->
    <div class="flex justify-center gap-4 mt-16 text-2xl flex-wrap">
        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 border-neutral-300 flex items-center justify-center gap-2 h-[52px]" href="/jobs?s=construction+engineer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
            </svg>

            <span class="text-md">Construction Engineer</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>

        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 border-neutral-300 flex items-center justify-center gap-2 h-[52px]" href="/jobs?s=security+guard">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>


            <span class="text-md">Security Guard</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>

        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 border-neutral-300 flex items-center justify-center gap-2 h-[52px]" href="/jobs?s=marketing">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
            </svg>
            <span class="text-md">Marketing</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>

        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 border-neutral-300 flex items-center justify-center gap-2 h-[52px]" href="/jobs?s=project+management">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <span class="text-md">Project Management</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>

        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 border-neutral-300 flex items-center justify-center gap-2 h-[52px]" href="/jobs?s=internship">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
            </svg>

            <span class="text-md">Internship</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>
        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 border-neutral-300 flex items-center justify-center gap-2 h-[52px]" href="/jobs?s=remote">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>

            <span class="text-md">Remote jobs</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>
        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 border-neutral-300 flex items-center justify-center gap-2 h-[52px]" href="/jobs?s=computer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
            </svg>
            <span class="text-md">Computer & software</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>
        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 border-neutral-300 flex items-center justify-center gap-2 h-[52px]" href="/jobs?s=human+resource">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span class="text-md">Human Resource</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>
        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 border-neutral-300 flex items-center justify-center gap-2 h-[52px]" href="/jobs?s=hospitality">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
            </svg>

            <span class="text-md">Hospitality</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>
    </div>


    <!-- Jobs you may be interested in  -->
    <div class="mt-24">
        <div class="flex justify-center">
            <h2 class="text-xl font-bold mb-3">Jobs you may be interested in</h2>
        </div>
        @if($recommendedJobs->count() > 0)
        <div class="card w-auto card-md  mt-6 grid gap-6 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1">
            @foreach($recommendedJobs as $job)
            <div class="lg:col-span-1 md:col-span-2">
                <a href="{{ route('jobs.show', ['id' => $job->id]) }}" style="text-decoration: none; color: inherit;">
                    <div class="card-body shadow-md rounded-md hover:shadow-xl hover:cursor-pointer transition-all duration-300">
                        <div class="flex justify-between gap-4 mb-1">
                            <div class="col-span-6">
                                <figure>
                                    <x-cloudinary::image
                                        public-id="{{ $job->employer->logo_url }}"
                                        width="48"
                                        height="48"
                                        crop="fill"
                                        alt="{{ $job->employer->company_title }} logo" />
                                </figure>
                            </div>
                            <div class="col-span-4 text-right">
                                <p>
                                    {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1 justify-start mb-1">
                            <p class="font-semibold text-md">{{ $job->title }}</p>
                            <p>{{ $job->employer->company_name }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="text-gray-600 flex gap-2 items-center">
                                <span class="text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </span>
                                <span class="text-gray-600">{{ App\Enums\Users\CountryEnum::from($job->country)->getLabel() }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @endforeach
        </div>

        @else
        <div class="text-center py-12">
            <h3 class="text-xl font-semibold text-gray-700">No recommended jobs</h3>
        </div>
        @endif
    </div>

    <!-- jobs by industry -->
    <div class="mt-24">
        <h2 class="text-xl font-bold mb-3">Featured Countries</h2>
        <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
            <div class="card bg-base-100 image-full w-96 shadow-sm ">
                <figure>
                    <img
                        src="assets/hongkong.jpg"
                        alt="Hong Kong" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Hong Kong</h2>
                    <p class="shadow-2xl">A fast-paced, competitive global finance and trade hub where international experience is highly valued, though local language skills are a key advantage</p>
                    <div class="card-actions justify-end">
                        <a href="/jobs?country=HK" class="btn btn-secondary">Explore jobs</a>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 image-full w-96 shadow-sm ">
                <figure>
                    <img
                        src="assets/nepal.jpg"
                        alt="Nepal" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Nepal</h2>
                    <p class="shadow-2xl">A growing market with strong opportunities in tourism, development, and IT outsourcing, where local networks and adaptability are crucial for career growth</p>
                    <div class="card-actions justify-end">
                        <a href="/jobs?country=NP" class="btn btn-secondary">Explore jobs</a>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 image-full w-96 shadow-sm ">
                <figure>
                    <img
                        src="assets/uae.jpg"
                        alt="United Arab Emirates" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">United Arab Emirates</h2>
                    <p class="shadow-2xl">A dynamic, tax-free hub for expatriates, offering high-growth opportunities in construction, tech, tourism, and finance, with a focus on project-based and contractual roles</p>
                    <div class="card-actions justify-end">
                        <a href="/jobs?country=AE" class="btn btn-secondary">Explore jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bold and aspirational slogan -->
    <div class="flex justify-center mt-32">
        <span class="text-rotate text-4xl">
            <span class="justify-items-center font-semibold">
                <span>Unlocking Extraordinary Talent.</span>
                <span>Don't Just Find a Job, Define a Career.</span>
                <span>Elevate Your Team. Elevate Your Game.</span>
                <span>The Architects of High-Performing Teams.</span>
                <span>Go Further, Faster.</span>
                <span>Talent is Everything. We Find It.</span>
            </span>
        </span>
    </div>

    <div class="mt-24 text-center bg-gradient-to-r from-blue-300 to-blue-600 py-12 px-6 rounded-xl text-white">
        <h2 class="text-3xl font-semibold ">Your Career Journey Starts Here</h2>
        <p class="mt-4 max-w-2xl mx-auto">Discover your next career opportunity with SGHRL, where global talent meets exceptional opportunities.</p>
    </div>

    @endsection