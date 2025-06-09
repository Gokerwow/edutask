<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Edutask') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="w-full h-screen">
        <div class="relative w-full h-screen overflow-hidden">
            <img class="absolute w-full" src="{{ asset('images/background/loginBG.jpg') }}" alt="">
            <div class="relative z-10 h-screen w-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100/30 dark:bg-gray-900/30 " >
                <div>
                    <a href="/" wire:navigate>
                        <x-application-logo/>
                    </a>
                </div>
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/20 dark:bg-gray-500/20 shadow-md overflow-hidden sm:rounded-lg backdrop-filter backdrop-blur-sm backdrop-saturate-100 backdrop-contrast-100">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
