<!doctype html>
<html lang="en" :class="{ 'theme-dark': dark }" x-data="data()">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>LocatorGIS | {{$title}} </title>
    <link rel="shortcut icon" href="{{ asset('assets/img/locatorGIS.png') }}" type="image/x-icon">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Link CSS -->
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
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Sidebar -->
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
            <!-- Desktop sidebar -->
            <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
                <div class="py-4 text-gray-500 dark:text-gray-400">
                    <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                        LocatorGIS
                    </a>
                    <ul class="mt-6">
                        <li class="relative px-6 py-3">
                            <a href="/user-report" class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/user-report.png') }}" alt="Logo Icon by the best icon" class="h-5 w-5">
                                </div>
                                <span class="ml-4">User Report</span>
                            </a>
                            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                        </li>
                        <li class="relative px-6 py-3">
                            <div class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/excavator.png') }}" alt="Logo" class="h-5 w-5">
                                </div>
                                <span class="ml-4">Excavator | {{$totalExca}} Unit </span>
                            </div>
                        </li>
                        <li class="relative px-6 py-3">
                            <div class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/dump-truck.png') }}" alt="Logo" class="h-5 w-5">
                                </div>
                                <span class="ml-4">Dump Point | {{$totalDumping}} Unit </span>
                            </div>
                        </li>
                        <li class="relative px-6 py-3">
                            <div class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                                @if ($latestWeather && file_exists(public_path('assets/img/cuaca-icons/' . strtolower($latestWeather->cuaca) . '.png')))
                                    <img src="{{ asset('assets/img/cuaca-icons/' . strtolower($latestWeather->cuaca) . '.png') }}" 
                                        alt="{{ $latestWeather->cuaca }}" 
                                        class="w-6">
                                @else
                                    <img src="{{ asset('assets/img/cuaca-icons/not-found-weather.png') }}" 
                                        alt="Cuaca tidak tersedia" 
                                        class="w-5">
                                @endif
                                <span class="ml-4">{{ $latestWeather->cuaca_label ?? 'Not Found' }} | {{ $latestWeather->curah_hujan ?? 'N/A' }} mm</span>
                            </div>
                        </li>
                        <li class="relative px-6 py-3 flex items-center space-x-3">
                            <div class="invert-icon">
                                <img src="{{ asset('assets/img/menu-icons/water-waves.png') }}" alt="Water Icon" class="h-5 w-5">
                                </div>                            
                            @if ($latestWaterDepth)
                                <div class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                    <p>QSV1: <span class="font-normal">{{ $latestWaterDepth->qsv_1 ?? 'N/A' }}</span></p>
                                    <p>H4: <span class="font-normal">{{ $latestWaterDepth->h4 ?? 'N/A' }}</span></p>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">Data tidak tersedia</p>
                            @endif
                        </li>
                    </ul>
                    <!-- Tombol Logout -->
                    <ul>
                        <li class="relative px-6 py-3">
                            <form method="POST" action="/auth/logout">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-sm font-semibold text-gray-800 dark:text-gray-100">
                                    <div class="invert-icon">
                                        <img src="{{ asset('assets/img/menu-icons/logout.png') }}" alt="Logout Icon by Pixel perfect" class="h-5 w-5 mr-2">
                                        <span>Logout</span>
                                    </div>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Mobile sidebar -->
            <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
                <div class="py-4 text-gray-500 dark:text-gray-400">
                    <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                        LocatorGIS
                    </a>
                    <ul class="mt-6">
                        <li class="relative px-6 py-3">
                            <a href="/user-report" class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/user-report.png') }}" alt="Logo Icon by the best icon" class="h-5 w-5">
                                </div>
                                <span class="ml-4">User Report</span>
                            </a>
                            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                        </li>
                        <li class="relative px-6 py-3">
                            <div class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/excavator.png') }}" alt="Logo" class="h-5 w-5">
                                </div>
                                <span class="ml-4">Excavator | {{$totalExca}} Unit </span>
                            </div>
                        </li>
                        <li class="relative px-6 py-3">
                            <div class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/dump-truck.png') }}" alt="Logo" class="h-5 w-5">
                                </div>
                                <span class="ml-4">Dump Point | {{$totalDumping}} Unit </span>
                            </div>
                        </li>
                        <li class="relative px-6 py-3">
                            <div class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                                @if ($latestWeather && file_exists(public_path('assets/img/cuaca-icons/' . strtolower($latestWeather->cuaca) . '.png')))
                                    <img src="{{ asset('assets/img/cuaca-icons/' . strtolower($latestWeather->cuaca) . '.png') }}" 
                                        alt="{{ $latestWeather->cuaca }}" 
                                        class="w-5">
                                @else
                                    <img src="{{ asset('assets/img/cuaca-icons/not-found-weather.png') }}" 
                                        alt="Cuaca tidak tersedia" 
                                        class="w-5">
                                @endif
                                <span class="ml-4">{{ $latestWeather->cuaca_label ?? 'Not Found' }} | {{ $latestWeather->curah_hujan ?? 'N/A' }} mm</span>
                            </div>
                        </li>
                        <li class="relative px-6 py-3 flex items-center space-x-3">
                            <div class="invert-icon">
                                <img src="{{ asset('assets/img/menu-icons/water-waves.png') }}" alt="Water Icon" class="h-5 w-5">
                                </div>                            
                            @if ($latestWaterDepth)
                                <div class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                    <p>QSV1: <span class="font-normal">{{ $latestWaterDepth->qsv_1 ?? 'N/A' }}</span></p>
                                    <p>H4: <span class="font-normal">{{ $latestWaterDepth->h4 ?? 'N/A' }}</span></p>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">Data tidak tersedia</p>
                            @endif
                        </li>
                    </ul>
                    <!-- Tombol Logout -->
                    <ul>
                        <li class="relative px-6 py-3">
                            <form method="POST" action="/auth/logout">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-sm font-semibold text-gray-800 dark:text-gray-100">
                                    <div class="invert-icon">
                                        <img src="{{ asset('assets/img/menu-icons/logout.png') }}" alt="Logout Icon by Pixel perfect" class="h-5 w-5 mr-2">
                                        <span>Logout</span>
                                    </div>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
        <div class="flex flex-col flex-1 w-full">
            <!-- Navbar -->
            <div class="flex flex-col flex-1 w-full">
                <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                    <div class="flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                        <!-- Mobile hamburger -->
                        <button @click="toggleSideMenu" class="p-1 -ml-1 mr-5 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" aria-label="Menu">
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <!-- Search input -->
                        <div class="flex justify-center flex-1 lg:mr-32">
                            <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                                <div class="absolute inset-y-0 flex items-center pl-2">
                                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:bg-gray-700 focus:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:bg-white dark:focus:bg-gray-600 focus:border-purple-300 focus:outline-none form-input" type="text" placeholder="Search for projects" aria-label="Search" />
                            </div>
                        </div>
                        <ul class="flex items-center flex-shrink-0 space-x-6">
                            <!-- Theme toggler -->
                            <li class="flex">
                                <button @click="toggleTheme" aria-label="Toggle color mode" class="rounded-md focus:outline-none focus:shadow-outline-purple" aria-label="Toggle color mode" id="theme-toggle">
                                    <template x-if="!dark">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                        </svg>
                                    </template>
                                    <template x-if="dark">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                                        </svg>
                                    </template>
                                </button>
                            </li>
                            <!-- Notifications menu -->
                            <li class="relative">
                                <button @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu" aria-label="Notifications" aria-haspopup="true" class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a6 6 0 016 6v3.586l.707.707a1 1 0 01.293.707V14a1 1 0 01-1 1H4a1 1 0 01-1-1v-.293a1 1 0 01.293-.707L4 11.586V8a6 6 0 016-6zm-4 14a2 2 0 004 0H6z"></path>
                                    </svg>
                                    <!-- Notification badge -->
                                    <span aria-hidden="true" class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-2 -translate-y-2 bg-red-600 border-2 border-white rounded-full"></span>
                                </button>
                                <template x-if="isNotificationsMenuOpen">
                                    <ul @click.away="closeNotificationsMenu" @keydown.escape="closeNotificationsMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-800">
                                        <li class="flex">
                                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="#">
                                                <span>Alerts</span>
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </li>
                            <!-- Profile menu -->
                            <li class="relative">
                                <button @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true" class="relative align-middle rounded-full focus:outline-none focus:shadow-outline-purple">
                                    <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('assets/img/foto.jpg') }}" alt="" aria-hidden="true">
                                </button>
                                <template x-if="isProfileMenuOpen">
                                    <ul @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-800">
                                        <li class="flex">
                                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="#">
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        <li class="flex">
                                            <form method="POST" action="/auth/logout">
                                                <button type="submit" class="w-full inline-flex items-center justify-between px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                                    <span>Log out</span>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </template>
                            </li>
                        </ul>
                    </div>
                </header>
            </div>
            <main class="h-full overflow-y-auto">
                <!-- Maps -->
                <div class="relative w-full h-full">
                    <iframe class="absolute top-0 left-0 w-full h-full rounded-lg shadow-xs" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8297.885022528028!2d117.42045017766056!3d2.02715899014462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x320def43f33ea91b%3A0x7e4dcd38dcbb294c!2sWorkshop%20MTL%20Binungan%20KM1!5e1!3m2!1sid!2sid!4v1721883321328!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </main>

            <!-- Form report -->
            <!-- modals form report -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full h-full items-center justify-center">
                <!-- Overlay background -->
                <div class="fixed inset-0 bg-black opacity-50"></div>
                <!-- Modal content -->
                <div class="relative w-full p-3 max-w-2xl bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Form Tambah Report
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="#">
                        <div class="grid gap-4 mt-2 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                            </div>
                            <div>
                                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                <input type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product brand" required="">
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                            </div>
                            <div>
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <input type="text" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Category" required="">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Add new Report
                        </button>
                        <button type="button" class="text-green-600 inline-flex items-center hover:text-white border border-green-600 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-900" data-modal-hide="defaultModal">
                            <svg class="mr-1 -ml-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Script -->
    <script>
        // Function to scroll smoothly to the top of the page
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Function to apply theme and invert icons accordingly
        function applyTheme() {
            const theme = document.body.classList.contains('dark') ? 'dark' : 'light';
            const icons = document.querySelectorAll('.invert-icon img');

            icons.forEach(icon => {
                icon.style.filter = theme === 'light' ? 'invert(1)' : 'invert(0)';
            });
        }

        // Functionality for modals: toggle and hide
        function setupModals() {
            const modalToggleBtns = document.querySelectorAll('[data-modal-toggle]');
            const modalHideBtns = document.querySelectorAll('[data-modal-hide]');

            // Toggle modal visibility
            modalToggleBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const modalId = btn.getAttribute('data-modal-toggle');
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.toggle('hidden');
                    }
                });
            });

            // Hide modal
            modalHideBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const modalId = btn.getAttribute('data-modal-hide');
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                });
            });
        }

        // Event listener for DOMContentLoaded
        document.addEventListener("DOMContentLoaded", function() {
            // Apply theme on page load
            applyTheme();

            // Theme toggle functionality
            const themeToggleButton = document.getElementById('theme-toggle');
            if (themeToggleButton) {
                themeToggleButton.addEventListener('click', function() {
                    document.body.classList.toggle('dark'); // Toggle 'dark' class
                    applyTheme(); // Apply updated theme
                });
            }

            // Setup modal functionality
            setupModals();
        });
    </script>

</body>

</html>