<!-- resources/views/errors/403.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocatorGIS | 403 - Forbidden</title>
	
    <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output-2.css') }}"/>

    <!-- JS -->
    <script src="{{ asset('assets/js/alpine.min.js') }}"></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
    <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script>
	
</head>
<body class="bg-yellow-100 min-h-screen flex items-center justify-center px-4">
    <div class="text-center max-w-2xl">
        <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold text-yellow-600">
            🚫 403 Forbidden – Area Terlarang
        </h1>
        <p class="text-base sm:text-lg md:text-xl text-gray-700 mt-4">
            Wilayah ini khusus personel berkewenangan.
        </p>
        <p class="text-base sm:text-lg md:text-xl text-gray-700 mt-4 mb-6">
            Maaf, kamu belum punya izin masuk ke zona ini. Silakan hubungi administrator kalau merasa ini keliru.
        </p>
        <a href="{{ url('/') }}"
           class="inline-block mt-6 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
            Back to Homepage
        </a>
    </div>
</body>
</html>
