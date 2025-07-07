<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>LocatorGIS | {{$title}} </title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-locatorgis/locatorgis-logo.png') }}" type="image/x-icon">
    
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
<body> 
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800" >
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
                <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('assets/img/view-exca.jpg') }}" alt="exca" />
                <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{ asset('assets/img/view-dump.jpg') }}" alt="dump" />
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full">
                    @if(session() -> has ('succes'))
                    <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('succes') }}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                    @endif
                    @if(session() -> has ('loginError'))
                    <div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('loginError') }}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                    @endif
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('assets/img/logo-locatorgis/locatorgis-logo.png') }}" alt="LocatorGIS Logo" class="w-20 h-20 mb-2">

                        <h2 class="mb-1 text-lg font-semibold text-center text-gray-700 dark:text-gray-200">
                            Selamat datang di Login Area
                        </h2>
                        <h4 class="mb-4 text-l font-semibold text-center text-gray-700 dark:text-gray-200">
                            Ayo mulai pantau lokasi
                        </h4>
                    </div>
                    <div x-data="{ role: null }">
                        <!-- Pilih role -->
                        <div class="flex flex-col items-center space-y-4">
                            <button @click="role = 'admin'" type="button" class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                                Login as Administrator
                            </button>
                            <button @click="role = 'operator'" type="button" class="w-full px-4 py-2 text-white bg-amber-600 rounded hover:bg-amber-700">
                                Login as Operator
                            </button>
                        </div>

                        <!-- Form Login Administrator -->
                        <div x-show="role === 'admin'" class="mt-6">
                            <form action="/auth/login" method="post">
                                @csrf
                                <input type="hidden" name="role" value="admin">
                                <div class="block text-sm mt-4">
                                    <input type="email" name="email" placeholder="name@example.com" required
                                        class="block w-full mt-1 text-gray-900 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                                </div>
                                <div class="block text-sm mt-4">
                                    <input type="password" name="password" placeholder="Password" required
                                        class="block w-full mt-1 text-gray-900 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                                </div>
                                <button type="submit"
                                    class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white bg-blue-600 rounded hover:bg-blue-700">
                                    Login as Administrator
                                </button>
                            </form>
                        </div>

                        <!-- Form Login Operator -->
                        <div x-show="role === 'operator'" class="mt-6">
                            <form action="/auth/login" method="post">
                                @csrf
                                <input type="hidden" name="role" value="operator">
                                <div class="block text-sm mt-4">
                                    <input type="text" name="username" placeholder="Username" required
                                        class="block w-full mt-1 text-gray-900 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-amber-400 focus:outline-none focus:shadow-outline-amber dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                                </div>
                                <button type="submit"
                                    class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white bg-amber-600 rounded hover:bg-amber-700">
                                    Login as Operator
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr class="mt-4">
                    <p class="m-1">
                        <a class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline" href="#" >
                            Forgot your password?
                        </a>
                    </p>
                    <br class="mt-5">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">&copy; 2025 <a href="#">PT. Fajar Anugerah Dinamika </a></span>
                </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
