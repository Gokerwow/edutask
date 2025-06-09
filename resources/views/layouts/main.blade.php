<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EduTask</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body>
    @include('sweetalert::alert')
    @livewireStyles
    @include('components.navbar')

    <div class="pt-[80px] min-h-[700px] flex items-center">
        @yield('content')
    </div>

    @include('components.footer')
    @livewireScripts
    @stack('scripts')
</body>
</html>
