@props(['totalExca', 'totalDumping', 'latestWeather', 'latestWaterDepth'])
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