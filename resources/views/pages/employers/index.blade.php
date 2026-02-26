@extends('layouts.app')

@section('title', 'Company list')

@section('content')
<div class="breadcrumbs text-sm">
    <ul>
        <li><a href="/">Home</a></li>
        <li>Companies</li>
    </ul>
</div>

<div class="container mx-auto py-8">
    @if(count($employers) === 0)
    <p class="text-gray-600">No companies found.</p>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 justify-center gap-4 mt-2 lg:mt-16 text-2xl flex-wrap">
        @foreach ($employers as $employer)
        <a class="btn shadow-none hover:shadow-xl rounded-xl bg-white text-black border-1 w-full border-neutral-300 h-[120px] grid grid-cols-4" href="{{ route('employers.show', $employer->id) }}">
            <div class="flex gap-4 items-center col-span-3">
                <figure>
                    <x-cloudinary::image
                        public-id="{{ $employer->logo_url }}"
                        width="48"
                        height="48"
                        crop="fit"
                        alt="{{ $employer->company_title }} logo" />
                </figure>

                <div class="text-left">
                    <p class="text-md">{{ $employer->company_name }}</p>
                    <p class="text-gray-400 font-light mt-2"><span class="badge badge-neutral badge-outline badge-sm">{{ $employer->company_industry ? App\Enums\Users\IndustryEnum::from($employer->company_industry->value)->getLabel() : 'N/A'}}</span></p>
                </div>
            </div>
            <div class="flex justify-end pr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </a>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $employers->links() }}
    </div>
    @endif
</div>
@endsection