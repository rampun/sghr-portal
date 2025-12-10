@extends('layouts.app')

@section('title', 'Job list')

@section('content')

<div class="grid grid-cols-12 gap-8 mt-8">
    <div class="col-span-8">
        <div class="card shadow-md">
            <div class="card-body">
                <div class="header">
                    <div class="flex justify-between">
                        <div class="content">
                            <h2 class="card-title">Senior Web Developer</h2>
                            <p class="text-gray-600 mt-1">X Corporation</p>
                            <div class="highlights flex flex-col gap-1 mt-2">
                                <div class="flex text-gray-600 items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    <span>
                                        Mid Level (3-5 years)
                                    </span>
                                </div>
                                <div class="flex text-gray-600 items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>

                                    <span>
                                        $3k - $5k
                                    </span>
                                </div>
                                <div class="flex text-gray-600 items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <span>
                                        Hong Kong
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="logo">
                            <figure>
                                <img
                                    class="object-cover w-[32px] h-[32px]"
                                    src="/logo-black.png"
                                    alt="X Logo" />
                            </figure>
                        </div>
                    </div>
                    <div class="flex w-full flex-col">
                        <div class="divider bg-gray-200 h-[1px]"></div>
                    </div>
                    <div class="meta flex gap-6 justify-between items-center">
                        <div class="flex gap-2">
                            <p class="posted">Posted: <span>4 days ago</span></p>|
                            <p class="posted">Openings: <span>1</span></p>|
                            <p class="posted">Applicants: <span>3</span></p>
                        </div>
                        <div class="register_login flex gap-2 items-center">
                            <a class="btn btn-outline btn-primary rounded-3xl">Register to apply</a>
                            <a class="btn btn-primary text-white rounded-3xl" href="/jobseeker">Login to appy</a>
                            <!-- <a class="btn btn-primary text-white rounded-3xl" href="#">Apply</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-[30px]"></div>
        <div class="card shadow-md">
            <div class="card-body">
                <div class="job_description">
                    <h3 class="text-md font-bold">Job description</h3>
                    <div>
                        <div>
                            <div> We are looking for Housekeeping Associates to join our team in the hospitality industry. The ideal candidate should have 0-2 years of experience and be able to work effectively in a fast-paced environment. </div>
                            <div> <br> <b> Roles and Responsibility </b> <br> <span> </span> </div>
                            <ul>
                                <li> Maintain high standards of cleanliness and hygiene in guest rooms and public areas. </li>
                                <li> Provide exceptional customer service to guests, responding promptly to their needs and resolving any issues professionally. </li>
                                <li> Collaborate with other departments to ensure seamless operations and excellent guest experiences. </li>
                                <li> Develop and implement effective cleaning schedules to minimize downtime and maximize efficiency. </li>
                                <li> Identify and report maintenance or repair needs to the appropriate personnel. </li>
                                <li> Participate in ongoing training and education to enhance skills and knowledge. </li>
                            </ul>
                            <div> <br> <b> Job Requirements </b> <br> <span> </span> </div>
                            <ul>
                                <li> Ability to work well under pressure and manage multiple tasks simultaneously. </li>
                                <li> Excellent communication and interpersonal skills, with the ability to work effectively with colleagues and guests. </li>
                                <li> Strong attention to detail and commitment to delivering high-quality results. </li>
                                <li> Familiarity with cleaning procedures and protocols, and the ability to follow instructions accurately. </li>
                                <li> Basic knowledge of hospitality industry practices and procedures is an advantage. </li>
                                <li> Ability to lift, push, and pull heavy objects, stand for long periods, and work in a physically demanding environment. </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="job_meta">
                    <ul>
                        <li><b>Industry:</b> <span>Information Technology</span></li>
                        <li><b>Employment Type:</b> <span>Full-time</span></li>
                        <li><b>Education:</b><span> N/A</span></li>
                    </ul>
                </div>
                <div class="keyskill">
                    <h3 class="text-md font-bold">Key Skills</h3>
                    <div class="flex gap-2 justify-start mt-2">
                        <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Cleaning</div>
                        <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Time manaement</div>
                        <div class="rounded-2xl w-auto badge badge-sm bg-gray-200 text-gray-800 text-normal border-0">Can do attitude</div>
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
                    <div class="flex justify-between">
                        <div class="content">
                            <div>
                                <h2 class="text-md font-bold">About company</h2>
                                <p class="text-gray-600 mt-1">X Corporation Company</p>
                            </div>
                            <div>
                                <h2 class="text-md font-bold">Company Info</h2>
                                <p> Address: Test addresss </p>
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
                <h2 class="text-md font-bold">Jobs you might be interested in</h2>
                <div class="flex justify-between gap-4 mt-4 mb-4">
                    <div class="job_content">
                        <h3 class="text-normal font-bold mb-1">Software Engineer</h3>
                        <p class="mb-2">Leapfrof Technology</p>
                        <div class="flex text-gray-600 items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>
                                Hong Kong
                            </span>
                        </div>
                    </div>
                    <div class="logo_posted flex flex-col text-right gap-2">
                        <figure>
                            <img
                                class="object-cover w-[32px] h-[32px]"
                                src="/logo-black.png"
                                alt="X Logo" />
                        </figure>
                        <p class="text-gray-600">Posted <span>4 days ago</span></p>
                    </div>
                </div>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>

                <!-- Job #2 -->
                <div class="flex justify-between gap-4 mt-4 mb-4">
                    <div class="job_content">
                        <h3 class="text-normal font-bold mb-1">Jr. Intern Engineer</h3>
                        <p class="mb-2">Facebook</p>
                        <div class="flex text-gray-600 items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>
                                Silicon Valley
                            </span>
                        </div>
                    </div>
                    <div class="logo_posted flex flex-col float-right gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 48 48">
                            <path fill="#3F51B5" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z"></path>
                            <path fill="#FFF" d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z"></path>
                        </svg>
                        <p class="text-gray-600">Posted <span>1 day ago</span></p>
                    </div>
                </div>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>

                <!-- Job #3 -->
                <div class="flex justify-between gap-4 mt-4 mb-4">
                    <div class="job_content">
                        <h3 class="text-normal font-bold mb-1">Jr. Intern Engineer</h3>
                        <p class="mb-2">Facebook</p>
                        <div class="flex text-gray-600 items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>
                                Silicon Valley
                            </span>
                        </div>
                    </div>
                    <div class="logo_posted flex flex-col float-right gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 48 48">
                            <path fill="#3F51B5" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z"></path>
                            <path fill="#FFF" d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z"></path>
                        </svg>
                        <p class="text-gray-600">Posted <span>1 day ago</span></p>
                    </div>
                </div>
                <div class="flex w-full flex-col">
                    <div class="divider bg-gray-200 h-[1px]"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection