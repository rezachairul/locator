<x-admin.layouts>
    <x-slot:title>{{$title}}</x-slot:title>
    <!-- Table -->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
        Table {{$title}}
    </h4>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="flex items-center justify-between flex-wrap gap-2 p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">
            <!-- Bagian Pencarian -->
            <div class="flex flex-1 lg:mr-32">
                <div class="relative w-full max-w-xl">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" class="w-full pl-8 pr-2 text-sm text-gray-900 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-400 dark:bg-gray-700 focus:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:bg-white dark:focus:bg-gray-600 focus:border-purple-300 focus:outline-none form-input" placeholder="Cari" required>
                </div>
            </div>

            <!-- Bagian Tombol -->
            <div class="flex gap-2">
                <!-- Tombol Create -->
                <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="flex items-center justify-center text-white bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-amber-600 dark:hover:bg-amber-700 focus:outline-none dark:focus:ring-amber-800">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Create
                </button>

                <!-- Tombol Import -->
                <!-- <button type="button" id="importModalButton" data-modal-target="importModal" data-modal-toggle="importModal" class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3.5 w-3.5 mr-2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                    Import
                </button> -->
                <!-- @if(session() -> has ('ImportError'))
                    <div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('ImportError') }}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif -->
                <!-- Modal Import -->
                <div id="importModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-md max-h-full">
                        <!-- Modal Content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal Header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Import File
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="importModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal Body -->
                            <div class="p-6">
                                <form action="{{ route('exca.import') }}" method="POST" enctype="multipart/form-data">
                                    <!-- {{ route('exca.import') }} -->
                                    @csrf
                                    <div class="mt-2 mb-4 sm:col-span-2">
                                        <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload File</label>
                                        <input type="file" name="file" id="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="file" required="">
                                    </div>
                                    <button type="submit" class="text-white m-1 inline-flex items-center  bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        Import
                                    </button>
                                    <button type="button" class="text-red-600 m-1 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" data-modal-hide="importModal">
                                        Cancel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Export -->
                <!-- <a href="{{ route('exca.export') }}">
                    <button type="button" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3.5 w-3.5 mr-2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Export
                    </button>
                </a> -->
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="whitespace-nowrap table-auto min-w-full">
                <thead>
                    <!-- Baris Pertama -->
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-2 py-1 text-center" rowspan="2">No</th>
                        <th class="px-2 py-1 text-center" rowspan="2">Loading Unit</th>
                        <th class="px-2 py-1 text-center" rowspan="2">Easting</th>
                        <th class="px-2 py-1 text-center" rowspan="2">Northing</th>
                        <th class="px-2 py-1 text-center" colspan="2">Elevation</th>
                        <th class="px-2 py-1 text-center" colspan="2">Front</th>
                        <th class="px-2 py-1 text-center" rowspan="2">Date</th>
                        <th class="px-2 py-1 text-center" rowspan="2">Actions</th>
                    </tr>
                    <!-- Baris Kedua -->
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-2 py-1 text-center">RL</th>
                        <th class="px-2 py-1 text-center">Actual</th>
                        <th class="px-2 py-1 text-center">Width</th>
                        <th class="px-2 py-1 text-center">Height</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @if ($excas->where('created_at', '>=', now()->toDateString())->isNotEmpty())
                        @foreach ( $excas->where('created_at', '>=', now()->toDateString())  as $key =>  $exca )
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-1 text-sm text-center">
                                    {{ $excas->firstItem() + $key }}
                                </td>
                                <td class="px-2 py-1">
                                    <div class="flex items-center text-xs">
                                        <div class="items-center">
                                            <p class="font-semibold">{{ $exca->loading_unit }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-1 text-xs text-center">
                                    {{ $exca->easting }}
                                </td>
                                <td class="px-2 py-1 text-xs text-center">
                                    {{ $exca->northing }}
                                </td>
                                <td class="px-2 py-1 text-xs text-center">
                                    {{ ($exca->elevation_rl)  }}
                                </td>
                                <td class="px-2 py-1 text-xs text-center">
                                    {{ $exca->elevation_actual }}
                                </td>
                                <td class="px-2 py-1 text-xs text-center">
                                    {{ $exca->front_width }}
                                </td>
                                <td class="px-2 py-1 text-xs text-center">
                                    {{ $exca->front_height }}
                                </td>
                                <td class="px-2 py-1 text-xs text-center">
                                    {{ $exca->created_at->format('d-m-Y')}}
                                </td>

                                <!-- Actions -->
                                <td class="px-2 py-1 text-xs text-center">
                                    <div class="flex justify-center space-x-4">
                                        <!-- Edit -->
                                        <button id="updateProductButton-{{ $exca->id }}" data-modal-target="updateProductModal-{{ $exca->id }}" data-modal-toggle="updateProductModal-{{ $exca->id }}" type="button"
                                            class="inline-block text-gray-500 hover:text-yellow-600 transition-colors duration-200"
                                            aria-label="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                        <!-- Modal Edit -->
                                        <div id="updateProductModal-{{ $exca->id }}" tabindex="-1" aria-hidden="true"
                                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                    <!-- Modal header -->
                                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                            Update {{$title}}
                                                        </h3>
                                                        <button type="button" data-modal-toggle="updateProductModal-{{ $exca->id }}"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-toggle="updateProductModal-{{ $exca->id }}">
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
                                                    @if (isset($exca))
                                                        <form action="{{route('exca.update', $exca->id)}}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="grid gap-4 mt-2 mb-4 sm:grid-cols-2">
                                                                <div>
                                                                    <label for="loading_unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Loading
                                                                        Unit</label>
                                                                    <input type="text" name="loading_unit" id="loading_unit"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                        placeholder="Input Loading Unit" required autofocus value="{{old('loading_unit', $exca->loading_unit)}}">
                                                                </div>
                                                                <div>
                                                                    <label for="easting"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Easting</label>
                                                                    <input type="text" name="easting" id="easting"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                        placeholder="Input Easting" required autofocus value="{{old('easting', $exca->easting)}}">
                                                                </div>
                                                                <div>
                                                                    <label for="northing"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Northing</label>
                                                                    <input type="text" name="northing" id="northing"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                        placeholder="Input Norting" required autofocus value="{{old('northing', $exca->northing)}}">
                                                                </div>
                                                                <div>
                                                                    <label for="elevation" 
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Elevation</label>
                                                                    <div class="grid grid-cols-2 gap-4">
                                                                        <input type="text" name="elevation_rl" id="elevation_rl"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm text-left rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                            placeholder="Input Elevation Actual" required autofocus value="{{old('elevation_rl', $exca->elevation_rl)}}">
                                                                        <input type="text" name="elevation_actual" id="elevation_actual"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm text-left rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                            placeholder="Input Elevation RL" required autofocus value="{{old('elevation_actual', $exca->elevation_actual)}}">
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <label for="front" 
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Front</label>
                                                                    <div class="grid grid-cols-2 gap-4">
                                                                        <input type="text" name="front_width" id="front_width"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                            placeholder="Front Width" required autofocus value="{{old('front_width', $exca->front_width)}}">
                                                                        <input type="text" name="front_height" id="front_height"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                            placeholder="Front Height" required autofocus value="{{old('front_height', $exca->front_height)}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Submit and Cancel Buttons -->
                                                             <div class="flex justify-end space-x-2 pt-4">
                                                                 <button type="submit"
                                                                     class="text-white inline-flex m-1 items-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                                                     <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                         <path fill-rule="evenodd"
                                                                             d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                             clip-rule="evenodd"></path>
                                                                     </svg>
                                                                     Update Data {{$title}}
                                                                 </button>
                                                                 <button type="button" data-modal-toggle="updateProductModal-{{ $exca->id }}"
                                                                     class="text-red-600 inline-flex m-1 items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                     <svg class="mr-1 -ml-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" fill="none" viewBox="0 0 24 24">
                                                                         <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                                             d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                     </svg>
                                                                     Cancel
                                                                 </button>
                                                             </div>
                                                        </form>
                                                    @else
                                                    <p>Data tidak ditemukan.</p>                                                 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                         

                                        <!-- Delete -->
                                        <button id="deleteButton-{{ $exca->id }}" data-modal-target="deleteModal-{{ $exca->id }}" data-modal-toggle="deleteModal-{{ $exca->id }}" type="button"
                                        class="inline-block text-gray-500 hover:text-red-600 transition-colors duration-200"
                                        aria-label="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                        <!-- Modal Delete -->
                                         
                                        <div id="deleteModal-{{ $exca->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                    <button type="button" data-modal-toggle="deleteModal-{{ $exca->id }}" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                    <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                                                    <div class="flex justify-center items-center space-x-4">
                                                        @if (isset($excas))
                                                            <form action="{{route('exca.destroy', $exca->id)}}" method="post">
                                                                @method ('DELETE')
                                                                @csrf
                                                                <button data-modal-toggle="deleteModal-{{ $exca->id }}" type="button" class="mr-2 py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
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
                    @else
                        <tr>
                            <td colspan="10" class="px-4 py-3 text-center text-gray-500 dark:text-gray-300">
                                Tidak ada data {{$title}} ditemukan untuk hari ini.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- Pagination & Showing -->
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <!-- Showing -->
            <span class="flex items-center col-span-3">
                Showing {{ $excas->firstItem() }} - {{ $excas->lastItem() }} out of {{ $excas->total() }}
            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
             <div class="col-span-4 flex items-center justify-end space-x-2">
                @if ($excas->onFirstPage())
                    <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $excas->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300">Previous</a>
                @endif
                <span class="text-gray-300">Page {{ $excas->currentPage() }} of {{ $excas->lastPage() }}</span>
                @if ($excas->hasMorePages())
                    <a href="{{ $excas->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300">Next</a>
                @else    
                    <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Next</span>            
                @endif
             </div>
        </div>
        <!-- Modals Create -->
        @include('operasional.exca.create')
    </div>
</x-admin.layouts>