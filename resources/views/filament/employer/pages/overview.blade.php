<x-filament-panels::page>
    <ul>
        @foreach($jobSeekerByCountry as $key => $item)
        <li>{{ App\Enums\Users\CountryEnum::from($key)->getLabel() }} : {{ $item }}</li>
        @endforeach
    </ul>

    <ul>
        @foreach($jobSeekerByIndustry as $key => $item)
        <li>{{ App\Enums\Users\IndustryEnum::from($key)->getLabel() }} : {{ $item }}</li>
        @endforeach
    </ul>

    <ul>
        @foreach($jobSeekerByExperience as $key => $item)
        <li>{{ App\Enums\Users\ExperienceLevelEnum::from($key)->getLabel() }} : {{ $item }}</li>
        @endforeach
    </ul>
</x-filament-panels::page>