@props(['title', 'totalExca', 'totalDumping', 'latestWeather', 'latestWaterDepth', 'hideSidebar' => false])

<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css','resources/js/app.js'])
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/${value}') }}" type="image/x-icon">
        
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        
        <!-- Link CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output-2.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/Chart.min.css') }}"/>
        
        <!-- JS -->
        <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
        <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
        <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    </head>

    <body> 
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
            @if (!$hideSidebar)
                <x-operator.sidebar
                    :totalExca="$totalExca ?? 0"
                    :totalDumping="$totalDumping ?? 0"
                    :latestWeather="$latestWeather ?? null"
                    :latestWaterDepth="$latestWaterDepth ?? null"
                />
            @endif
            <div class="flex flex-col flex-1 w-full">
                <x-operator.navbar></x-operator.navbar>
                <main class="h-full overflow-y-auto">
                    {{$slot}}
                </main>
            </div>
        </div>
    </body>
</html>