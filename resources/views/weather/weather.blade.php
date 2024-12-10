<x-layouts>
    <x-slot:title>{{$title}}</x-slot:title>
    <!-- Cards with title -->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Cuaca Saat Ini
    </h4>

    <div class="grid gap-6 mb-8 md:grid-cols-2 justify-center place-items-center">
        @if($latestWeather)
            <!-- PT Fajar Anugerah Dinamika -->
            <div class="w-72 h-36 bg-gradient-to-r from-[#141e30] to-[#243b55] rounded-lg shadow-[5px_10px_50px_rgba(0,0,0,0.7),-5px_0px_250px_rgba(0,0,0,0.7)] flex flex-col justify-center relative text-white cursor-pointer transition-all duration-300 ease-in-out overflow-hidden hover:shadow-[5px_10px_50px_rgba(0,0,0,1),-5px_0px_250px_rgba(0,0,0,1)]">
                <p class="text-[20px] mt-0 ml-4 font-semibold font-sans">
                    <span>{{ $latestWeather->cuaca_label }}</span>
                    <br>
                    <span class="text-[15px] ml-1">Curah Hujan | {{$latestWeather->curah_hujan}} mm</span>
                </p>
                <p class="text-[18px] mt-0 ml-4 font-medium font-sans">PT. Fajar Anugerah Dinamika</p>
                @if ($latestWeather->cuaca && file_exists(public_path('assets/img/cuaca-icons/' . strtolower($latestWeather->cuaca) . '.png')))
                    <img src="{{ asset('assets/img/cuaca-icons/' . strtolower($latestWeather->cuaca) . '.png') }}" alt="{{ $latestWeather->cuaca }}" class="absolute right-4 top-4 w-20 transition-all duration-300 ease-in-out hover:w-[6rem]" oncontextmenu="return false;">
                @else
                    <span>Cuaca tidak tersedia</span>
                @endif
            </div>
        @else
            <div class="w-72 h-36 bg-gray-500 rounded-lg flex justify-center items-center text-white">
                <span>Data cuaca tidak tersedia</span>
            </div>
        @endif
        
        <!-- BMKG -->
        <div class="w-72 h-36 bg-gradient-to-r from-[#141e30] to-[#243b55] rounded-lg shadow-[5px_10px_50px rgba(0,0,0,0.7),-5px_0px_250px rgba(0,0,0,0.7)] flex flex-col justify-center relative text-white cursor-pointer transition-all duration-300 ease-in-out overflow-hidden hover:shadow-[5px_10px_50px rgba(0,0,0,1),-5px_0px_250px rgba(0,0,0,1)]">
            <p class="text-[20px] mt-0 ml-4 font-semibold font-sans">
                <span id="weather-description"></span> 
                <br>
                <span id="temperature" class="text-[15px] ml-1"></span>
            </p>
            <p class="text-[18px] mt-0 ml-4 font-medium font-sans">
                <img src="{{ asset('assets/img/bmkg-2.png') }}" alt="BMKG logo" class="inline w-6 h-6 mr-2">
                BMKG
            </p>
        </div>
    </div>    

    <!-- Table -->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Table {{$title}}
    </h4>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">
            <!-- Bagian Pencarian -->
            <div class="flex flex-1 justify-center lg:mr-32">
                <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" class="w-full pl-8 pr-2 text-sm text-gray-900 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-400 dark:bg-gray-700 focus:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:bg-white dark:focus:bg-gray-600 focus:border-purple-300 focus:outline-none form-input" placeholder="Cari" required>
                </div>
            </div>
            <!-- Bagian Tombol Tambah -->
            <div class="flex-shrink-0">
                <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="flex items-center justify-center text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Tambah {{$title}}
                </button>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 text-center">Nomor</th>
                        <th class="px-4 py-3 text-center">Cuaca</th>
                        <th class="px-4 py-3 text-center">Ikon</th>
                        <th class="px-4 py-3 text-center">Curah Hujan</th>
                        <th class="px-4 py-3 text-center">Date</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead> 
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($weathers as $weather )
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm text-center">
                            {{ $loop->iteration}}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                {{ $weather->cuaca_label }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                @if ($weather->cuaca && file_exists(public_path('assets/img/cuaca-icons/' . strtolower($weather->cuaca) . '.png')))
                                    <img src="{{ asset( 'assets/img/cuaca-icons/' . strtolower($weather->cuaca) . '.png') }}" alt="{{ $weather->cuaca }}" width="30">
                                @else
                                    <span>Cuaca tidak tersedia</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-xs text-center">
                                {{ $weather->curah_hujan }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                {{ $weather->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex item-center justify-center space-x-4 text-sm">
                                    <!-- Edit / Update Button -->
                                    <button id="updateProductButton-{{ $weather->id }}" data-modal-target="updateProductModal-{{ $weather->id }}" data-modal-toggle="updateProductModal-{{ $weather->id }}" type="button" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" >
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" ></path>
                                        </svg>
                                    </button>
                                    <!-- Modal Update -->
                                    <div id="updateProductModal-{{ $weather->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <!-- Modal header -->
                                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Update {{$title}}
                                                    </h3>
                                                    <button type="button" data-modal-toggle="updateProductModal-{{ $weather->id }}"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-toggle="updateProductModal">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                 @if (isset($weather))
                                                    <form action="{{route('weather.update', $weather->id)}}" method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="mt-2 mb-4 sm:col-span-2">
                                                            <div class="mt-2 mb-4">
                                                                <label for="cuaca"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Cuaca</label>
                                                                    <select id="cuaca" name="cuaca"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                        required autofocus>
                                                                        <option value="cerah" {{ old('cuaca', $weather->cuaca) === 'cerah' ? 'selected' : '' }}>Cerah</option>
                                                                        <option value="cerah_berawan" {{ old('cuaca', $weather->cuaca) === 'cerah_berawan' ? 'selected' : '' }}>Cerah Berawan</option>
                                                                        <option value="berawan" {{ old('cuaca', $weather->cuaca) === 'berawan' ? 'selected' : '' }}>Berawan</option>
                                                                        <option value="berawan_tebal" {{ old('cuaca', $weather->cuaca) === 'berawan_tebal' ? 'selected' : '' }}>Berawan Tebal</option>
                                                                        <option value="hujan_ringan" {{ old('cuaca', $weather->cuaca) === 'hujan_ringan' ? 'selected' : '' }}>Hujan Ringan</option>
                                                                        <option value="hujan_sedang" {{ old('cuaca', $weather->cuaca) === 'hujan_sedang' ? 'selected' : '' }}>Hujan Sedang</option>
                                                                        <option value="hujan_lebat" {{ old('cuaca', $weather->cuaca) === 'hujan_lebat' ? 'selected' : '' }}>Hujan Lebat</option>
                                                                        <option value="hujan_petir" {{ old('cuaca', $weather->cuaca) === 'hujan_petir' ? 'selected' : '' }}>Hujan Petir</option>
                                                                        <option value="kabut" {{ old('cuaca', $weather->cuaca) === 'kabut' ? 'selected' : '' }}>Kabut</option>
                                                                    </select>
                                                            </div>
                                                            <div class="mt-2 mb-4">
                                                                <label for="curah_hujan"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Curah Hujan</label>
                                                                <input type="text" name="curah_hujan" id="curah_hujan"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                    placeholder="Dalam Milimeter" required autofocus value="{{old('curah_hujan', $weather->curah_hujan)}}" required="">
                                                            </div>
                                                        </div>
                                                        <button type="submit" 
                                                            class="text-white inline-flex m-1 items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Update Data {{$title}}
                                                        </button>
                                                        <button type="button" data-modal-toggle="updateProductModal-{{ $weather->id }}"
                                                            class="text-red-600 inline-flex m-1 items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" data-modal-hide="defaultModal">
                                                            <svg class="mr-1 -ml-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                                    d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                            Cancel
                                                        </button>
                                                    </form>                                                 
                                                    @else
                                                        <p>Data tidak ditemukan.</p>             
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <button id="deleteButton-{{ $weather->id }}" data-modal-target="deleteModal-{{ $weather->id }}" data-modal-toggle="deleteModal-{{ $weather->id }}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" >
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" ></path>
                                        </svg>                                            
                                    </button>
                                    <!-- delete button modals -->
                                    <div id="deleteModal-{{ $weather->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <button type="button" data-modal-toggle="deleteModal-{{ $weather->id }}" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                                                <div class="flex justify-center items-center space-x-4">
                                                    @if (isset($weathers))
                                                        <form action="{{route('weather.destroy', $weather->id)}}" method="post">
                                                            @method ('DELETE')
                                                            @csrf
                                                            <button data-modal-toggle="deleteModal-{{ $weather->id }}" type="button" class="mr-2 py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                No, cancel
                                                            </button>
                                                            <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                Yes, I'm sure
                                                            </button>
                                                        </form>
                                                    @else
                                                        <p>Data Tidak Dietmukan</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>                    
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing 1-10 of 100
            </span>
            <span class="col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <li>
                            <button
                                class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                aria-label="Previous">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                1
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                2
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                3
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                4
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                5
                            </button>
                        </li>
                        <li>
                            <button
                                class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                aria-label="Next">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </span>
        </div>
        
        <!-- Modals Create -->
        @include('weather.create')
    </div>
</x-layouts>