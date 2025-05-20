<div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="flex flex-col h-full py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                <img src="{{ asset('assets/img/logo-locatorgis/locatorgis-logo.png') }}" alt="Logo LocatorGIS" class="w-6 h-6">
                LocatorGIS
            </a>
            <ul class="mt-6 flex-grow">
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
                <!-- Operator -->
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('operator') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/operator">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/operator.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Operator</span>
                    </a>
                </li>
                <!-- Operasional -->
                <li class="relative px-6 py-3 group">
                    <span class="{{ request()->is('operasional*') || request()->is('exca') || request()->is('dumping') || request()->is('weather') || request()->is('waterdepth') || request()->is('material') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a  href="#" class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/operasional_minning.png') }}" alt="Logo by Icon by Karyative" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Operasional</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li>
                            <a href="/operasional/operasional" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/op_mining-2.png') }}" alt="Logo" class="h-5 w-5 mr-2">
                                </div>
                                Operasional
                            </a>
                        </li>
                        <li>
                            <a href="/operasional/exca" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/excavator.png') }}" alt="Logo" class="h-5 w-5 mr-2">
                                </div>
                                Load Point
                            </a>
                        </li>
                        <li>
                            <a href="/operasional/dumping" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/dump-truck.png') }}" alt="Logo" class="h-5 w-5 mr-2">
                                </div>
                                Waste Dump
                            </a>
                        </li>
                        <li>
                            <a href="/operasional/weather" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/cloud.png') }}" alt="Logo" class="h-5 w-5 mr-2">
                                </div>
                                Weather
                            </a>
                        </li>
                        <li>
                            <a href="/operasional/waterdepth" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/water-waves.png') }}" alt="Logo" class="h-5 w-5 mr-2">
                                </div>
                                Water Depth
                            </a>
                        </li>
                        <li>
                            <a href="/operasional/material" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/mineral.png') }}" alt="Logo-Icon by Becris" class="h-5 w-5 mr-2">
                                </div>
                                Material's
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Laporan -->
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('laporan') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/laporan/incident-user">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/incident-user.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Incident User</span>
                    </a>
                </li>
                <!-- Informasi -->
                <li class="relative px-6 py-3 group">
                    <span class="{{ request()->is('informasi*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="#">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/info.png') }}" alt="Logo by Icon by redempticon" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Informasi</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li>
                            <a href="/informasi/tentang-sistem" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/about-system.png') }}" alt="Logo Icon by kerismaker" class="h-5 w-5 mr-2">
                                </div>
                                Tentang Sistem
                            </a>
                        </li>
                        <li>
                            <a href="/informasi/bantuan" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/panduan.png') }}" alt="Logo Icon by phatplus" class="h-5 w-5 mr-2">
                                </div>
                                Bantuan
                            </a>
                        </li>
                        <li>
                            <a href="/informasi/kontak" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/contact.png') }}" alt="Logo Icon by Luch Phou" class="h-5 w-5 mr-2">
                                </div>
                                Kontak
                            </a>
                        </li>
                    </ul>
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
        <div class="flex flex-col h-full py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                <img src="{{ asset('assets/img/logo-locatorgis/locatorgis-logo.png') }}" alt="Logo LocatorGIS" class="w-6 h-6">
                LocatorGIS
            </a>
            <ul class="mt-6 flex-grow">
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
                <!-- Operator -->
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('operator') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/operator">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/operator.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Operator</span>
                    </a>
                </li>
                <!-- Operasional -->
                <li class="relative px-6 py-3 group">
                    <span class="{{ request()->is('operasional*') || request()->is('exca') || request()->is('dumping') || request()->is('weather') || request()->is('waterdepth') || request()->is('material') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a href="/operasional/operasional" class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/operasional_minning.png') }}" alt="Logo by Icon by Karyative" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Operasional</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li>
                            <a href="/operasional/exca" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/excavator.png') }}" alt="Logo" class="h-5 w-5 mr-2">
                                </div>
                                Load Point
                            </a>
                        </li>
                        <li>
                            <a href="/operasional/dumping" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/dump-truck.png') }}" alt="Logo" class="h-5 w-5 mr-2">
                                </div>
                                Waste Dump
                            </a>
                        </li>
                        <li>
                            <a href="/operasional/weather" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/cloud.png') }}" alt="Logo" class="h-5 w-5 mr-2">
                                </div>
                                Weather
                            </a>
                        </li>
                        <li>
                            <a href="/operasional/waterdepth" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/water-waves.png') }}" alt="Logo" class="h-5 w-5 mr-2">
                                </div>
                                Water Depth
                            </a>
                        </li>
                        <li>
                            <a href="/operasional/material" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/mineral.png') }}" alt="Logo-Icon by Becris" class="h-5 w-5 mr-2">
                                </div>
                                Material's
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Laporan -->
                <li class="relative px-6 py-3">
                    <span class="{{ request()->is('laporan') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/laporan/incident-user">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/incident-user.png') }}" alt="Logo" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Incident User</span>
                    </a>
                </li>
                <!-- Informasi -->
                <li class="relative px-6 py-3 group">
                    <span class="{{ request()->is('informasi*') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="#">
                        <div class="invert-icon">
                            <img src="{{ asset('assets/img/menu-icons/info.png') }}" alt="Logo by Icon by redempticon" class="h-5 w-5">
                        </div>
                        <span class="ml-4">Informasi</span>
                    </a>
                    <!-- Sub-menu -->
                    <ul class="hidden group-hover:block w-full mt-2 space-y-2 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <li>
                            <a href="/informasi/tentang-sistem" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/about-system.png') }}" alt="Logo Icon by kerismaker" class="h-5 w-5 mr-2">
                                </div>
                                Tentang Sistem
                            </a>
                        </li>
                        <li>
                            <a href="/informasi/bantuan" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/panduan.png') }}" alt="Logo Icon by phatplus" class="h-5 w-5 mr-2">
                                </div>
                                Bantuan
                            </a>
                        </li>
                        <li>
                            <a href="/informasi/kontak" class="px-6 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center">
                                <div class="invert-icon">
                                    <img src="{{ asset('assets/img/menu-icons/contact.png') }}" alt="Logo Icon by Luch Phou" class="h-5 w-5 mr-2">
                                </div>
                                Kontak
                            </a>
                        </li>
                    </ul>
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