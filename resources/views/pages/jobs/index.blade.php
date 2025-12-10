@extends('layouts.app')

@section('title', 'Job list')

@section('content')

<div class="grid grid-cols-12 gap-8 mt-8">
    <!-- filter -->
    <div class="col-span-4 bg-amber-700">Filter</div>
    <!-- filtered job list -->
    <div class="col-span-8">
        <div class="flex text-black justify-between">
            <p class="text-normal"> 1-20 of 300 jobs</p>
            <p class="text-normal">Sort by</p>
        </div>

        <div class="card w-full card-md flex flex-col gap-10">
            <div x-data
                @click="window.location.href = '{{ route('jobs.show', ['title' => 'test']) }}'"
                class="card-body shadow-md rounded-md hover:shadow-xl hover:cursor-pointer transition-all duration-300">
                <div class="grid grid-cols-12 gap-4 mb-1">
                    <div class="col-span-1">
                        <figure>
                            <img
                                class="object-cover w-[32px] h-[32px]"
                                src="/logo-black.png"
                                alt="X Logo" />
                        </figure>
                    </div>
                    <div class="col-span-9">
                        <h2 class="card-title">Senior Developer</h2>
                        <div class="flex gap-4">
                            <span class="company text-gray-600">X Corp</span>
                            <p class="location flex items-center gap-1">
                                <span class="text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>


                                </span>
                                <span class="text-gray-600">Hong Kong</span>
                        </div>
                    </div>
                    <div class="col-span-2 text-right">
                        <p class="font-bold">
                            $3k-$5k
                        </p>
                    </div>
                </div>
                <div class="grid mb-1">
                    <p class="line-clamp-3 text-normal">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
                <div class="flex gap-2 justify-start mb-1">
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Remote work</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Full Time</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">3-5 years</div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-gray-600">
                        <p>4 days ago</p>
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
            <div class="card-body shadow-md rounded-md hover:shadow-xl hover:cursor-pointer transition-all duration-300">
                <div class="grid grid-cols-12 gap-4 mb-1">
                    <div class="col-span-1">
                        <figure>
                            <img
                                class="object-cover w-[32px] h-[32px]"
                                src="/logo-black.png"
                                alt="X Logo" />
                        </figure>
                    </div>
                    <div class="col-span-9">
                        <h2 class="card-title">Senior Developer</h2>
                        <div class="flex gap-4">
                            <span class="company text-gray-600">X Corp</span>
                            <p class="location flex items-center gap-1">
                                <span class="text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>


                                </span>
                                <span class="text-gray-600">Hong Kong</span>
                        </div>
                    </div>
                    <div class="col-span-2 text-right">
                        <p class="font-bold">
                            $3k-$5k
                        </p>
                    </div>
                </div>
                <div class="grid mb-1">
                    <p class="line-clamp-3 text-normal">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
                <div class="flex gap-2 justify-start mb-1">
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Remote work</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Full Time</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">3-5 years</div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-gray-600">
                        <p>4 days ago</p>
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
            <div class="card-body shadow-md rounded-md hover:shadow-xl hover:cursor-pointer transition-all duration-300">
                <div class="grid grid-cols-12 gap-4 mb-1">
                    <div class="col-span-1">
                        <figure>
                            <img
                                class="object-cover w-[32px] h-[32px]"
                                src="/logo-black.png"
                                alt="X Logo" />
                        </figure>
                    </div>
                    <div class="col-span-9">
                        <h2 class="card-title">Senior Developer</h2>
                        <div class="flex gap-4">
                            <span class="company text-gray-600">X Corp</span>
                            <p class="location flex items-center gap-1">
                                <span class="text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>


                                </span>
                                <span class="text-gray-600">Hong Kong</span>
                        </div>
                    </div>
                    <div class="col-span-2 text-right">
                        <p class="font-bold">
                            $3k-$5k
                        </p>
                    </div>
                </div>
                <div class="grid mb-1">
                    <p class="line-clamp-3 text-normal">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
                <div class="flex gap-2 justify-start mb-1">
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Remote work</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Full Time</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">3-5 years</div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-gray-600">
                        <p>4 days ago</p>
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
            <div class="card-body shadow-md rounded-md hover:shadow-xl hover:cursor-pointer transition-all duration-300">
                <div class="grid grid-cols-12 gap-4 mb-1">
                    <div class="col-span-1">
                        <figure>
                            <img
                                class="object-cover w-[32px] h-[32px]"
                                src="/logo-black.png"
                                alt="X Logo" />
                        </figure>
                    </div>
                    <div class="col-span-9">
                        <h2 class="card-title">Senior Developer</h2>
                        <div class="flex gap-4">
                            <span class="company text-gray-600">X Corp</span>
                            <p class="location flex items-center gap-1">
                                <span class="text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>


                                </span>
                                <span class="text-gray-600">Hong Kong</span>
                        </div>
                    </div>
                    <div class="col-span-2 text-right">
                        <p class="font-bold">
                            $3k-$5k
                        </p>
                    </div>
                </div>
                <div class="grid mb-1">
                    <p class="line-clamp-3 text-normal">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
                <div class="flex gap-2 justify-start mb-1">
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Remote work</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Full Time</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">3-5 years</div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-gray-600">
                        <p>4 days ago</p>
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
            <div class="card-body shadow-md rounded-md hover:shadow-xl hover:cursor-pointer transition-all duration-300">
                <div class="grid grid-cols-12 gap-4 mb-1">
                    <div class="col-span-1">
                        <figure>
                            <img
                                class="object-cover w-[32px] h-[32px]"
                                src="/logo-black.png"
                                alt="X Logo" />
                        </figure>
                    </div>
                    <div class="col-span-9">
                        <h2 class="card-title">Senior Developer</h2>
                        <div class="flex gap-4">
                            <span class="company text-gray-600">X Corp</span>
                            <p class="location flex items-center gap-1">
                                <span class="text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>


                                </span>
                                <span class="text-gray-600">Hong Kong</span>
                        </div>
                    </div>
                    <div class="col-span-2 text-right">
                        <p class="font-bold">
                            $3k-$5k
                        </p>
                    </div>
                </div>
                <div class="grid mb-1">
                    <p class="line-clamp-3 text-normal">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
                <div class="flex gap-2 justify-start mb-1">
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Remote work</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Full Time</div>
                    <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">3-5 years</div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-gray-600">
                        <p>4 days ago</p>
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
        </div>
    </div>
</div>

@endsection