@extends('layouts.app')

@section('title', 'Job list')

@section('content')
<div class="breadcrumbs text-sm">
    <ul>
        <li><a href="/">Home</a></li>
        <li>Jobs</li>
    </ul>
</div>

<div x-data="jobFilter()" x-init="initFilters()" class="container mx-auto py-8">
    <div class="grid grid-cols-12 gap-8 mt-8">
        <!-- filter -->
        <div class="col-span-3 card w-full card-md flex flex-col gap-10">
            <div class="card-body shadow-md rounded-md job_type">
                <!-- Search -->
                <div>
                    <h3 class="text-md font-bold mb-2">
                        Search for
                    </h3>
                    <div class="flex gap-2 justify-between">
                        <input x-model="filters.s"
                            @input.debounce.500ms="applyFilters()"
                            type="text"
                            class="input input-sm text-gray-600 bg-gray-50 w-[240px] border-gray-600"
                            name="s"
                            value="<?= $_GET['s'] ?? '' ?>"
                            placeholder="jobs, skills" />
                    </div>
                    <div class="flex w-full flex-col">
                        <div class="divider bg-gray-200 h-[1px]"></div>
                    </div>
                </div>

                <!-- Job Industry -->
                <div>
                    <h3 class="text-md font-bold mb-2">
                        Industry
                    </h3>
                    <div class="flex flex-col gap-2">
                        @foreach ($industries as $industry)
                        <label class="label text-gray-600">
                            <input
                                type="checkbox"
                                name="{{ $industry }}"
                                class="checkbox checkbox-primary checkbox-sm"
                                value="{{ $industry }}"
                                x-model="filters.industry"
                                @change="applyFilters()" />
                            <span class="">{{ App\Enums\Users\IndustryEnum::from($industry->value)->getLabel() }}</span>
                        </label>
                        @endforeach
                    </div>
                    <div class="flex w-full flex-col">
                        <div class="divider bg-gray-200 h-[1px]"></div>
                    </div>
                </div>

                <!-- Job type -->
                <div>
                    <h3 class="text-md font-bold mb-2">
                        Type
                    </h3>
                    <div class="flex flex-col gap-2">
                        @foreach (App\Enums\Jobs\TypeEnum::cases() as $type)
                        <label class="label text-gray-600">
                            <input
                                type="checkbox"
                                name="{{ $type->value }}"
                                class="checkbox checkbox-primary checkbox-sm"
                                value="{{ $type->value }}"
                                x-model="filters.job_type"
                                @change="applyFilters()" />
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
                            <input
                                type="checkbox"
                                name="{{ $experienceLevel->value }}"
                                class="checkbox checkbox-primary checkbox-sm"
                                value="{{ $experienceLevel->value }}"
                                x-model="filters.experience"
                                @change="applyFilters()" />
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
                            <input
                                type="number"
                                class="input input-sm text-gray-600 bg-gray-50 w-[100px] border-gray-600"
                                placeholder="Min"
                                x-model="filters.min_salary"
                                @input.debounce.500ms="applyFilters()" />
                        </fieldset>
                        <fieldset class="fieldset">
                            <input
                                type="number"
                                class="input input-sm text-gray-600 bg-gray-50 w-[100px] border-gray-600"
                                placeholder="Max."
                                x-model="filters.max_salary"
                                @input.debounce.500ms="applyFilters()" />
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
                            <input
                                type="checkbox"
                                name="{{ $location->value }}"
                                class="checkbox checkbox-primary checkbox-sm"
                                value="{{ $location->value }}"
                                x-model="filters.remote"
                                @change="applyFilters()" />
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
                        Country
                    </h3>
                    <div class="flex flex-col gap-2">
                        @foreach ($countries as $country)
                        <label class="label text-gray-600">
                            <input
                                type="checkbox"
                                name="{{ $country }}"
                                class="checkbox checkbox-primary checkbox-sm"
                                value="{{ $country }}"
                                x-model="filters.country"
                                @change="applyFilters()" />
                            <span class="">{{ App\Enums\Users\CountryEnum::from($country)->getLabel() }}</span>
                        </label>
                        @endforeach
                    </div>
                    <div class="flex w-full flex-col">
                        <div class="divider bg-gray-200 h-[1px]"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Listings -->
        <div class="col-span-9">
            <!-- Results Count -->
            <div class="mb-6">
                <p class="text-gray-600" x-text="`Found ${totalJobs} jobs`"></p>
            </div>

            <!-- Active Filters -->
            <div class="mb-4 flex flex-wrap gap-2" x-show="hasActiveFilters()">
                <template x-for="(value, key) in activeFilters" :key="key">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm flex items-center">
                        <span x-text="getFilterLabel(key, value)"></span>
                        <button @click="removeFilter(key)" class="ml-2 text-blue-600 hover:text-blue-800">
                            &times;
                        </button>
                    </span>
                </template>
            </div>

            <!-- Jobs List -->
            <div id="jobs-container">
                @include('partials.job_list', ['jobs' => $jobs])
            </div>

            <!-- Loading Indicator -->
            <div x-show="loading" class="text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <p class="mt-2">Loading jobs...</p>
            </div>
        </div>

    </div>
</div>
@endsection

@push('sghrl-scripts')
<script>
    function jobFilter() {
        return {
            filters: {
                s: '',
                job_type: [],
                industry: [],
                min_salary: '',
                max_salary: '',
                remote: [],
                experience: [],
                country: [],
                // page: 1
            },
            loading: false,
            totalJobs: {{$jobs->total()}},
            initFilters() {
                // Get filters from URL
                const urlParams = new URLSearchParams(window.location.search);

                this.filters.s = urlParams.get('s') || '';

                const job_type = urlParams.get('job_type');
                this.filters.job_type = job_type ? job_type.split(',') : [];

                const industry = urlParams.get('industry');
                this.filters.industry = industry ? industry.split(',') : [];

                const experience = urlParams.get('experience');
                this.filters.experience = experience ? experience.split(',') : [];

                this.filters.min_salary = urlParams.get('min_salary') || '';
                this.filters.max_salary = urlParams.get('max_salary') || '';

                const remote = urlParams.get('remote');
                this.filters.remote = remote ? remote.split(',') : [];

                const country = urlParams.get('country');
                this.filters.country = country ? country.split(',') : [];


                // this.filters.page = urlParams.get('page') || 1;
            },

            async fetchData(url) {
                try {
                    const response = await fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    // Manually check for non-network errors (e.g., 404 Not Found)
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    // Wait for the response body to be parsed as JSON
                    const data = await response.json();
                    document.getElementById('jobs-container').innerHTML = data.jobs;
                    this.totalJobs = data.total_jobs;

                } catch (error) {
                    console.error("There was a problem with your fetch request:", error);
                } finally {
                    this.loading = false;
                }
            },


            applyFilters() {
                this.loading = true;

                console.log('Applying filters:', this.filters);
                
                // Build URL with filters
                const url = new URL('{{ route("jobs.index") }}');

                // Add filters to URL
                Object.keys(this.filters).forEach(key => {
                    const value = this.filters[key];
                    if (value) {
                        if (Array.isArray(value) && value.length > 0) {
                            url.searchParams.set(key, value.join(','));
                        } else if (!Array.isArray(value)) {
                            url.searchParams.set(key, value);
                        }
                    }
                });

                // Update browser URL (without reloading page)
                window.history.pushState({}, '', url.toString());

                // Call the function
                this.fetchData(url.toString());
            },


            clearFilters() {
                this.filters = {
                    s: '',
                    job_type: [],
                    industry: [],
                    min_salary: '',
                    max_salary: '',
                    remote: [],
                    experience: [],
                    country: [],
                    page: 1
                };

                // Clear URL and reload
                window.history.pushState({}, '', '{{ route("jobs.index") }}');
                this.applyFilters();
            },

            removeFilter(filterKey) {
                if (Array.isArray(this.filters[filterKey])) {
                    this.filters[filterKey] = [];
                } else {
                    this.filters[filterKey] = '';
                }
                this.applyFilters();
            },

            hasActiveFilters() {
                return Object.values(this.filters).some(value => {
                    if (Array.isArray(value)) return value.length > 0;
                    return value !== '' && value !== null;
                });
            },

            get activeFilters() {
                const active = {};
                Object.keys(this.filters).forEach(key => {
                    const value = this.filters[key];
                    if (value) {
                        if (Array.isArray(value) && value.length > 0) {
                            active[key] = value;
                        } else if (!Array.isArray(value) && value !== '') {
                            active[key] = value;
                        }
                    }
                });
                return active;
            },

            getFilterLabel(key, value) {
                const labels = {
                    's': `Search: ${value}`,
                    'industry': `Industry: ${value}`,
                    'job_type': `Job Type: ${this.formatJobType(value)}`,
                    'remote': `Remote: ${this.formatRemoteOption(value)}`,
                    'min_salary': `Min Salary: $${value}`,
                    'max_salary': `Max Salary: $${value}`,
                    'experience': `Experience: ${this.formatExperience(value)}`,
                    'country': `Country: ${this.formatCountry(value)}`,
                };
                return labels[key] || `${key}: ${value}`;
            },

            formatJobType(type) {
                const types = {
                    'FULL_TIME': 'Full Time',
                    'PART_TIME': 'Part Time',
                    'CONTRACT': 'Contract',
                    'INTERNSHIP': 'Internship',
                };
                return types[type] || type;
            },

            formatExperience(experience) {
                const experiences = {
                    'ENTRY_LEVEL': 'Entry Level (0-2 years)',
                    'MID_LEVEL': 'Mid Level (3-5 years)',
                    'SENIOR_LEVEL': 'Senior Level (6-10 years)',
                    'MANAGEMENT': 'Management (10+ years)',
                    'EXECUTIVE': 'Executive (15+ years)',
                };
                return experiences[experience] || experience;
            },
            formatRemoteOption(remote) {
                const options = {
                    'ONSITE': 'Onsite',
                    'REMOTE': 'Remote',
                    'HYBRID': 'Hybrid',
                };
                return options[remote] || remote;
            },

            formatCountry(country) {
                const countries = {
                    'IN': 'India',
                    'HK': 'Hong Kong',
                    'NP': 'Nepal',
                    'MO': 'Macau',
                    'MY': 'Malaysia',
                    'QA': 'Qatar',
                    'UA': 'United Arab Emirates',
                    'PH': 'Philippines',
                    // Add other countries as needed
                };
                return countries[country] || country;
            }
        }
    }
</script>

@endpush