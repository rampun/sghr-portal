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

    <div class="stats stats-vertical lg:stats-horizontal shadow">
        <div class="stat">
            <div class="stat-title">Downloads</div>
            <div class="stat-value">31K</div>
            <div class="stat-desc">Jan 1st - Feb 1st</div>
        </div>

        <div class="stat">
            <div class="stat-title">New Users</div>
            <div class="stat-value">4,200</div>
            <div class="stat-desc">↗︎ 400 (22%)</div>
        </div>

        <div class="stat">
            <div class="stat-title">New Registers</div>
            <div class="stat-value">1,200</div>
            <div class="stat-desc">↘︎ 90 (14%)</div>
        </div>
    </div>
</x-filament-panels::page>