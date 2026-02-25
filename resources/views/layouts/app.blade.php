    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'SGHRL')</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        @vite('resources/css/app.css')

         
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        @filamentScripts
        @stack('sghrl-scripts')
        <style>
            /* Apply Inter globally */
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>

    <body>
        <header>
            @include('partials.header')
        </header>
        <main class="py-6 bg-gray-50 min-h-dvh pb-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <footer class="bg-gray-50 ">
            @include('partials.footer')
        </footer>

    </body>

    </html>