<div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                LocatorGIS
            </a>
            <ul class="mt-6">
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/dashboard">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('maps') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/maps">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/maps.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Maps</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('exca') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="exca">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/excavator.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Load Point</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('dumping') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/dumping">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/dump-truck.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Waste Dump</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('weather') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/weather">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/cloud.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Weather</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('waterdepth') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/waterdepth">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/water-waves.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Water Depth</span>
                    </a>
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
                    <span class="{{ request()->is('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/dashboard">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('maps') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/maps">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/maps.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Maps</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('exca') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="exca">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/excavator.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Load Point</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('dump-point') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/dumping">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/dump-truck.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Waste Dump</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('weather') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/weather">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/cloud.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Weather</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('waterdepth') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/waterdepth">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/water-waves.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Water Depth</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>