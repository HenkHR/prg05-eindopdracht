<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-white bg-black">
        <div class="flex flex-row min-h-screen">

            @auth
                <div>
                    @include('layouts.navigation')
                </div>
            @endauth

            <div class="text-white bg-black">

            <!-- Page Content -->
            <main class="text-white bg-black">
                {{ $slot }}
            </main>
            </div>
        </div>
    </body>
</html>
