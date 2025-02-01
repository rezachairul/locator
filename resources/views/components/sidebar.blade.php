<div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                LocatorGIS
            </a>
            <ul class="mt-6">
                <!-- Dashboard -->
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/dashboard">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
                <!-- Maps -->
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('maps') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/maps">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/maps.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Maps</span>
                    </a>
                </li>
            </ul>
            <ul>
                <!-- Operasional -->
                <li class="relative px-6 py-3 group">
                <span class="{{ request()->is('operasional*') || request()->is('exca') || request()->is('dumping') || request()->is('weather') || request()->is('waterdepth') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="#">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/operasional_minning.png') }}" alt="Logo by Icon by Karyative" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Operasional</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li>
                            <a href="/exca" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <img src="{{ asset('assets/img/menu-icons/excavator.png') }}" alt="Logo" class="h-5 w-5 mr-2 dark:invert">
                                Load Point
                            </a>
                        </li>
                        <li>
                            <a href="/dumping" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <img src="{{ asset('assets/img/menu-icons/dump-truck.png') }}" alt="Logo" class="h-5 w-5 mr-2 dark:invert">
                                Waste Dump
                            </a>
                        </li>
                        <li>
                            <a href="/weather" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <img src="{{ asset('assets/img/menu-icons/cloud.png') }}" alt="Logo" class="h-5 w-5 mr-2 dark:invert">
                                Weather
                            </a>
                        </li>
                        <li>
                            <a href="/waterdepth" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <img src="{{ asset('assets/img/menu-icons/water-waves.png') }}" alt="Logo" class="h-5 w-5 mr-2 dark:invert">
                                Water Depth
                            </a>
                        </li>
                        <li>
                            <a href="#" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <img src="{{ asset('assets/img/menu-icons/mineral.png') }}" alt="Logo-Icon by Becris" class="h-5 w-5 mr-2 dark:invert">
                                Materials
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Laporan -->
                <li class="relative px-6 py-3 group">
                    <span class="{{ request()->is('laporan*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                        </svg>
                        <span class="ml-4">Laporan</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li><a href="/laporan/user-operasional" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Laporan Insiden User </a></li>
                        <li><a href="/laporan/harian" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Laporan Harian</a></li>
                        <li><a href="/laporan/bulanan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Laporan Bulanan</a></li>
                    </ul>
                </li>
                <!-- Informasi -->
                <li class="relative px-6 py-3 group">
                    <span class="{{ request()->is('informasi*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <span class="ml-4">Informasi</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li><a href="/informasi/tentang-sistem" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Tentang Sistem</a></li>
                        <li><a href="/informasi/bantuan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Bantuan</a></li>
                        <li><a href="/informasi/kontak" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Kontak</a></li>
                    </ul>
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
                <!-- Dashboard -->
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/dashboard">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
                <!-- Maps -->
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('maps') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/maps">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/maps.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Maps</span>
                    </a>
                </li>
            </ul>
            <ul>
                <!-- Operasional -->
                <li class="relative px-6 py-3 group">
                    <span class="{{ request()->is('operasional*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="#">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/operasional_minning.png') }}" alt="Logo by Icon by Karyative" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Operasional</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li>
                            <a href="/exca" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <img src="{{ asset('assets/img/menu-icons/excavator.png') }}" alt="Logo" class="h-5 w-5 mr-2 dark:invert">
                                Load Point
                            </a>
                        </li>
                        <li>
                            <a href="/dumping" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <img src="{{ asset('assets/img/menu-icons/dump-truck.png') }}" alt="Logo" class="h-5 w-5 mr-2 dark:invert">
                                Waste Dump
                            </a>
                        </li>
                        <li>
                            <a href="/weather" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <img src="{{ asset('assets/img/menu-icons/cloud.png') }}" alt="Logo" class="h-5 w-5 mr-2 dark:invert">
                                Weather
                            </a>
                        </li>
                        <li>
                            <a href="/waterdepth" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <img src="{{ asset('assets/img/menu-icons/water-waves.png') }}" alt="Logo" class="h-5 w-5 mr-2 dark:invert">
                                Water Depth
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Laporan -->
                <li class="relative px-6 py-3 group">
                    <span class="{{ request()->is('laporan*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                        </svg>
                        <span class="ml-4">Laporan</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li><a href="/laporan/user-operasional" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Laporan Insiden User </a></li>
                        <li><a href="/laporan/harian" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Laporan Harian</a></li>
                        <li><a href="/laporan/bulanan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Laporan Bulanan</a></li>
                    </ul>
                </li>

                <!-- Informasi -->
                <li class="relative px-6 py-3 group">
                    <span class="{{ request()->is('informasi*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <span class="ml-4">Informasi</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li><a href="/informasi/tentang-sistem" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Tentang Sistem</a></li>
                        <li><a href="/informasi/bantuan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Bantuan</a></li>
                        <li><a href="/informasi/kontak" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700">Kontak</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
</div>