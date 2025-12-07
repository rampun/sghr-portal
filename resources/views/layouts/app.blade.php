    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'SGHRL')</title>
        @vite('resources/css/app.css')

    </head>

    <body>
        @include('partials.header')
        <main class="py-6 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <footer>
            {{-- Common footer content --}}
        </footer>
    </body>

    </html>