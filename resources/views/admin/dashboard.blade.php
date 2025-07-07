<x-admin.layouts>
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

    
    <br>
</x-admin.layouts>