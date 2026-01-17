    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'SGHRL')</title>
        @vite('resources/css/app.css')

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        @stack('sghrl-scripts')
    </head>

    <body>
        <header>
            @include('partials.header')
        </header>
        <main class="py-6 bg-gray-50 min-h-dvh">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <footer>
            {{-- Common footer content --}}
        </footer>
    </body>

    </html>