    @extends('layouts.app')

    @section('title', 'Home Page')

    @section('content')

    <div class="text-center mt-6">
        <h1 class="text-black text-4xl text-center font-bold mb-3">Find your dream job now</h1>
        <p>Explore jobs and apply for your dream job! </p>
    </div>
    <div class="search_jobs mt-16 join flex justify-center gap-0">
        <form method="GET" action="{{ route('jobs.index') }}">
            <label class="input validator join-item bg-white border-1  border-neutral-600 shadow-xl w-[650px] h-[48px]">
                <input type="text" name="s" class="bg-white shadow-2xs " placeholder="Search jobs, skills" value="<?= htmlspecialchars($_GET['s'] ?? '') ?>" required />
            </label>
            <button class="btn btn-neutral join-item h-[48px]">Search</button>
        </form>
    </div>

    @endsection