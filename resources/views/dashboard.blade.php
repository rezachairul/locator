<x-layouts>
    <x-slot:title>{{$title}}</x-slot:title>

    <!-- Card -->
    <div class="grid gap-6 mb-8 md:grid-cols-4 xl:grid-cols-4">
        <!-- Excavator -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4" >
                <img src="{{asset('assets/img/ikon-exca-card.png')}}" alt="Logo" class="w-12 hover:scale-125 transition">
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                    Load Point
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" >
                    {{ $totalExca }}
                </p>
            </div>
        </div>
        <!-- Dumping Truck -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4" >
                <img src="{{asset('assets/img/ikon-truck-card.png')}}" alt="Logo" class="w-12 hover:scale-125 transition">
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                    Waste Dump
                </p> 
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" >
                    {{ $totalDumping }}
                </p>
            </div>
        </div>
        
        <!-- Weather -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4">
                @if ($latestWeather && file_exists(public_path('assets/img/cuaca-icons/' . strtolower($latestWeather->cuaca) . '.png')))
                    <img src="{{ asset('assets/img/cuaca-icons/' . strtolower($latestWeather->cuaca) . '.png') }}" 
                        alt="{{ $latestWeather->cuaca }}" 
                        class="w-12 hover:scale-125 transition">
                @else
                    <img src="{{ asset('assets/img/cuaca-icons/not-found-weather.png') }}" 
                        alt="Cuaca tidak tersedia" 
                        class="w-12 hover:scale-125 transition">
                @endif
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    {{ $latestWeather->cuaca_label ?? 'Not Found' }}
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $latestWeather->curah_hujan ?? 'N/A' }} mm
                </p>
            </div>
        </div>

        <!-- Water Depth -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4">
                <img src="{{ asset('assets/img/depth-water-fall.png') }}" alt="Logo" class="w-12 hover:scale-125 transition">
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Water Depth
                </p>
                @if ($latestWaterDepth)
                    <div class="grid grid-cols-2 gap-2">
                        <p class="text-xs font-normal text-gray-700 dark:text-gray-200">
                            QSV1
                        </p>
                        <p class="text-xs font-normal text-gray-700 dark:text-gray-200">
                            {{ $latestWaterDepth->qsv_1 }}
                        </p>
                        <p class="text-xs font-normal text-gray-700 dark:text-gray-200">
                            H4
                        </p>
                        <p class="text-xs font-normal text-gray-700 dark:text-gray-200">
                            {{ $latestWaterDepth->h4 }}
                        </p>
                    </div>
                @else
                    <p class="text-xs font-thin text-gray-700 dark:text-gray-200">
                        Data belum tersedia
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <h4 class="mt-10 mb-4 ml-8 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Statistik LocatorGIS
    </h4>

    
    <!-- Tabel Opsional -->
    <!-- 
    <div class="w-full overflow-hidden rounded-lg shadow-xs" x-data="{ isModalOpen: false, modalType: '' }">
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">
            
            <div class="flex flex-1 justify-center lg:mr-32">
                <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                    <div>
                        <h5 class="mr-3 font-semibold dark:text-white"> Upload Data LocatorGIS</h5>
                        <p class="text-gray-500 dark:text-gray-400">Manage all your existing users or add a new one</p>
                    </div>
                </div>
            </div>
            
            <div class="flex-shrink-0">
                <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="flex items-center justify-center text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-cyan-600 dark:hover:bg-cyan-700 focus:outline-none dark:focus:ring-cyan-800">
                    <svg class="h-3.5 w-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8"/>
                    </svg>
                    Upload Data
                </button>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                        <th class="px-4 py-3 text-center">Jenis</th>
                        <th class="px-4 py-3 text-center">Jumlah</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Date</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" >
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block" >
                                    <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy" />
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true" ></div>
                                </div>
                                <div>
                                    <p class="font-semibold">Excavator</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        10x Developer
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            5
                        </td>
                        <td class="px-4 py-3 text-xs text-center">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100" >
                                Approved
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            6/10/2020
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex item-center justify-center space-x-4 text-sm">
                                <button @click="isModalOpen = true; modalType = 'excavator'" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block" >
                                    <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy" />
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true" ></div>
                                </div>
                                <div>
                                    <p class="font-semibold">Dumping Point</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        10x Developer
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            2
                        </td>
                        <td class="px-4 py-3 text-xs text-center">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100" >
                                Approved
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            6/10/2020
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex item-center justify-center space-x-4 text-sm">
                                <button @click="isModalOpen = true; modalType = 'dump-point'" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                    </svg>
                                </button>
                            </div>
                        </td>                        
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block" >
                                    <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy" />
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true" ></div>
                                </div>
                                <div>
                                    <p class="font-semibold">Weather</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        10x Developer
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            Cerah
                        </td>
                        <td class="px-4 py-3 text-xs text-center">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100" >
                                Approved
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            6/10/2020
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex item-center justify-center space-x-4 text-sm">
                                <button @click="isModalOpen = true; modalType = 'weather'" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block" >
                                    <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy" />
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true" ></div>
                                </div>
                                <div>
                                    <p class="font-semibold">Water Depth</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        10x Developer
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            10
                        </td>
                        <td class="px-4 py-3 text-xs text-center">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100" >
                                Approved
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            6/10/2020
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex item-center justify-center space-x-4 text-sm">
                                <button @click="isModalOpen = true; modalType = 'waterdepth'" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                        
                        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform translate-y-1/2" @click.away="closeModal" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 lg:max-w-5xl" role="dialog" id="modal">
                            
                            <header class="flex justify-end">
                                <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" @click="isModalOpen = false">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                                        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </header>
                            
                            <div class="mt-4 mb-6">
                                
                                <template x-if="modalType === 'excavator'">
                                    <div>
                                        
                                        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                            Tabel Excavator
                                        </p>
                                        <p class="text-sm text-gray-700 dark:text-gray-400">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum et
                                            eligendi repudiandae voluptatem tempore!
                                        </p>
                                    </div>
                                </template>
                                <template x-if="modalType === 'dump-point'">
                                    <div>
                                        
                                        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                            Tabel Dump-Point
                                        </p>
                                        <p class="text-sm text-gray-700 dark:text-gray-400">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum et
                                            eligendi repudiandae voluptatem tempore!
                                        </p>
                                    </div>
                                </template>
                                <template x-if="modalType === 'weather'">
                                    <div>
                                        
                                        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                            Tabel Weather
                                        </p>
                                        <p class="text-sm text-gray-700 dark:text-gray-400">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum et
                                            eligendi repudiandae voluptatem tempore!
                                        </p>
                                    </div>
                                </template>
                                <template x-if="modalType === 'waterdepth'">
                                    <div>
                                        
                                        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                            Tabel Water Depth
                                        </p>
                                        <p class="text-sm text-gray-700 dark:text-gray-400">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum et
                                            eligendi repudiandae voluptatem tempore!
                                        </p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    
                </tbody>
            </table>
        </div>
        
        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-700">
                    
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Upload Data LocatorGIS
                        </h3>
                        <button type="button" data-modal-toggle="defaultModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form action="#">
                        <div class="grid gap-4 mt-2 mb-4 sm:grid-cols-2">
                            <div class="flex items-center justify-center w-full sm:col-span-2">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 ">
                                    <div class="flex flex-col text-sm font-medium items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">.xlsx, .ods, .csv</p>
                                    </div>
                                    <input id="dropzone-file" type="file" class="hidden" />
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="text-white inline-flex m-1 items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Add new Data Titik
                        </button>
                        <button type="button" data-modal-toggle="defaultModal" class="text-red-600 inline-flex m-1 items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg class="mr-1 -ml-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <br>
</x-layouts>