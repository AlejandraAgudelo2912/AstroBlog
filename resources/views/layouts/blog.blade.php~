<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!--archivos de JS y css-->
        @vite('resources/css/app.css', 'resources/js/app.js')
        @livewireStyles
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100 dark:bg-black text-gray-900 dark:text-gray-200">
        @include('partials.navbar')

        <div class="flex min-h-screen">
            @include('components.sidebar')

            <div class="flex-1">
                <header class="bg-gray-200 dark:bg-gray-800 p-4 ml-64">
                    {{ $header ?? '' }}
                </header>

                <main class="min-h-screen bg-gray-100 dark:bg-gray-900/80 text-gray-900 dark:text-gray-200 p-6 ml-64">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @livewireScripts
    </body>
</html>
