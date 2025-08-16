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

    <!-- JS -->
    <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
    <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>

</head>
<body class="bg-red-100 min-h-screen flex items-center justify-center px-4">
    <div class="text-center max-w-2xl">
        <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold text-red-600">
            🔐 401 Unauthorized – Belum Masuk Site
        </h1>
        <p class="text-base sm:text-lg md:text-xl text-gray-700 mt-4">
            Akses Ditolak! Kamu belum mengenakan helm dan ID-mu belum terdaftar.
        </p>
        <p class="text-base sm:text-lg md:text-xl text-gray-700 mt-4 mb-6">
            Coba login dulu sebelum masuk ke area tambang. Keamanan adalah prioritas!
        </p>
        <a href="{{ url('/auth/login') }}"
           class="inline-block mt-6 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
            Go to Login
        </a>
    </div>
</body>

</html>