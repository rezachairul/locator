@foreach($dumpings as $dumping)
<!-- Modal Edit -->
<div id="updateProductModal-{{ $dumping->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update {{$title}}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="updateProductModal-{{ $dumping->id }}">
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
            @if (isset($dumping))
            <form action="{{route('admin.operasional.dumping.update', $dumping->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="grid gap-4 mt-2 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="disposial"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Nama Disposial</label>
                        <input type="text" name="disposial" id="disposial"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Input Nama Disposial" required autofocus value="{{old('disposial', $dumping->disposial)}}">
                    </div>
                    <div>
                        <label for="northing"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left ">Northing</label>
                        <input type="text" name="northing" id="northing"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Input Northing" required autofocus value="{{old('northing', $dumping->northing)}}">
                    </div>
                    <div>
                        <label for="easting"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left ">Easting</label>
                        <input type="text" name="easting" id="easting"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Input Easting" required autofocus value="{{old('easting', $dumping->easting)}}">
                    </div>
                    <div>
                        <label for="elevation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left ">Elevation</label>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="elevation_rl" id="elevation_rl"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm text-left  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Elevation RL" required autofocus value="{{old('elevation_rl', $dumping->elevation_rl)}}">
                            <input type="text" name="elevation_actual" id="elevation_actual"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm text-left  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Elevation Actual" required autofocus value="{{old('elevation_actual', $dumping->elevation_actual)}}">
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
                    <button type="button" data-modal-toggle="updateProductModal-{{ $dumping->id }}"
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
            <p>Data tidak ditemukan</p>
            @endif
        </div>
    </div>
</div>
@endforeach