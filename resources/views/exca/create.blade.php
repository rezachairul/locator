<!-- Modals Create -->
<div id="defaultModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Form Tambah {{$title}}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="defaultModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form action="/exca" method="POST">
                @csrf
                <div class="grid gap-4 mt-2 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="pit"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PIT</label>
                        <select id="pit"  name="pit"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option selected="" value="qsv1s">QSV1S</option>
                            <option value="qsv3">QSV3</option>
                        </select>
                    </div>
                    <div>
                        <label for="loading_unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loading
                            Unit</label>
                        <select id="loading_unit" name="loading_unit"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option selected="" value="fex400_441">FEX400-441</option>
                            <option value="fex400_419">FEX400-419</option>
                            <option value="fex400_449">FEX400-449</option>
                            <option value="fex400_454">FEX400-454</option>
                            <option value="fex400_456">FEX400-456</option>
                        </select>
                    </div>
                    <div>
                        <label for="dumping"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waste Dump</label>
                        <select id="dumping"  name="dumping_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @if (isset($dumpings) && $dumpings->isNotEmpty())
                                @foreach ($dumpings as $dumping)
                                    <option value="{{ $dumping->id }}">{{ $dumping->disposial_label }}</option>
                                @endforeach
                            @else
                                <option value="">No Waste Dump available</option>
                            @endif
                        </select>
                    </div>
                    <div>
                        <label for="material"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Material</label>
                        <select id="material"  name="material_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @if (isset($materials) && $materials->isNotEmpty())
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                            @else
                                <option value="">No materials available</option>
                            @endif
                        </select>
                    </div>
                    <div>
                        <label for="easting"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Easting</label>
                        <input type="text" name="easting" id="easting"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Easting" required>
                    </div>
                    <div>
                        <label for="northing"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Northing</label>
                        <input type="text" name="northing" id="northing"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Northing" required>
                    </div>
                    <div>
                        <label for="elevation" 
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Elevation</label>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="elevation_rl" id="elevation_rl"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Elevation RL" required>
                            <input type="text" name="elevation_actual" id="elevation_actual"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Elevation Actual" required>
                        </div>
                    </div>
                    <div>
                        <label for="front" 
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Front</label>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="front_width" id="front_width"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Front Width" required>
                            <input type="text" name="front_height" id="front_height"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Front Height" required>
                        </div>
                    </div>
                    <div>
                        <label for="dop" 
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DOP</label>
                        <input type="text" name="dop" id="dop"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="DOP" required>
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
                    Add new Data {{$title}}
                </button>
                <button type="button"
                    class="text-red-600 inline-flex m-1 items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" data-modal-hide="defaultModal">
                    <svg class="mr-1 -ml-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Cancel
                </button>
            </form>
        </div>
    </div>
</div>