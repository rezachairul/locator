<!-- resources/views/errors/401.blade.php -->
<!DOCTYPE html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>LocatorGIS | 401 - Unauthorized</title>

    <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output-2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/Chart.min.css') }}"/>

    <!-- JS -->
    <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/charts-lines.js') }}"></script>
    <script src="{{ asset('assets/js/charts-pie.js') }}"></script>
    <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>

</head>
<body class="bg-red-100 h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-600">401</h1>
        <p class="text-xl text-gray-700 mt-4">Oops! You are not authorized to access this page.</p>
        <a href="{{ url('/auth/login') }}" class="mt-6 px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600">Go to Login</a>
    </div>
</body>
</html>