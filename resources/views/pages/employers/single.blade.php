@extends('layouts.app')

@section('title', 'Job list')

@section('content')
<div class="breadcrumbs text-sm">
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/employers">Companies</a></li>
        <li>{{ $employer->company_name }}</li>
    </ul>
</div>

<div class="mt-8">
    <div class="flex gap-6 items-center mb-6">
        <x-cloudinary::image
            public-id="{{ $employer->logo_url }}"
            width="82"
            height="82"
            crop="fit"
            alt="{{ $employer->company_name }} logo" />
        <div class="text-left">
            <h1 class="text-xl font-bold">{{ $employer->company_name }}</h1>
            <p><span class="badge badge-neutral badge-outline badge-sm">{{ $employer->company_industry ? App\Enums\Users\IndustryEnum::from($employer->company_industry->value)->getLabel() : 'N/A'}}</span></p>
        </div>
    </div>

    <div class="tabs tabs-border">
        <input type="radio" name="job_detail_tab" class="tab" aria-label="Overview" checked="checked" />
        <div class="tab-content  py-10">
            <div class="col-span-4 card shadow-md">
                <div class="card-body">
                    <div class="header">
                        <h2 class="text-lg font-semibold">About {{ $employer->company_name }}</h2>

                        <p class="text-gray-600 mt-1">{{ $employer->company_description }}</p>

                        <div class="mt-4">
                            <p><b>Size:</b> {{ App\Enums\Users\CompanySizeEnum::from($employer->company_size->value)->getLabel() }} </p>
                            <p><b>Inudstry:</b> {{ App\Enums\Users\IndustryEnum::from($employer->company_industry->value)->getLabel() }} </p>
                            <p><b>Website:</b> {{ $employer->website ?? 'N/A'}} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="radio" name="job_detail_tab" class="tab" aria-label="Jobs" />
        <div class="tab-content  py-10">
            @include('partials.job_list', ['jobs' => $jobs])
        </div>
    </div>

</div>
@endsection