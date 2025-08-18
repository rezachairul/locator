<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>LocatorGIS | {{$title}} </title>

    <!-- Favicon -->
    <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/default-favicon.png') }}" data-base-url="{{ asset('assets/img') }}" type="image/x-icon">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output-2.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/Chart.min.css') }}" /> -->

    <!-- JS -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
    <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Pusher -->

</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-admin.sidebar></x-admin.sidebar>
        <div class="flex flex-col flex-1 w-full">
            <x-admin.navbar></x-admin.navbar>
            <main class="h-full p-5 overflow-y-auto">
                <x-admin.header>{{$title}}</x-admin.header>
                {{$slot}}
            </main>
        </div>
    </div>
</body>

</html>