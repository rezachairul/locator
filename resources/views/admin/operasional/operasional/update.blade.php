@foreach($operasionals as $operasional)
<!-- Modal Edit -->
<div id="updateProductModal-{{ $operasional->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Update {{$title}}
                </h3>
                <button type="button" data-modal-toggle="updateProductModal-{{ $operasional->id }}"
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
            @if (isset($operasional))
            <form action="{{route('admin.operasional.operasional.update', $operasional->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="grid gap-4 mt-2 mb-4 sm:grid-cols-2">
                    <!-- PIT -->
                    <div>
                        <label for="pit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">PIT</label>
                        <input type="text" name="pit" id="pit"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan PIT" required autofocus
                            value="{{ old('pit', optional($operasional)->pit) }}">
                    </div>

                    <!-- DOP -->
                    <div>
                        <label for="dop" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">DOP</label>
                        <input type="text" name="dop" id="dop"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan DOP" required autofocus
                            value="{{ old('dop', optional($operasional)->dop) }}">
                    </div>

                    <!-- Load Unit -->
                    <div>
                        <label for="loading_unit"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Load Unit</label>
                        <select id="loading_unit" name="loading_unit_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @if (isset($excas) && $excas->isNotEmpty())
                            @foreach ($excas as $exca)
                            <option value="{{ $exca->id }}"
                                {{ old('loading_unit_id', optional($operasional)->loading_unit_id) == $exca->id ? 'selected' : '' }}>
                                {{ $exca->loading_unit }}
                            </option>
                            @endforeach
                            @else
                            <option value="">No Loading Unit available</option>
                            @endif
                        </select>
                    </div>

                    <!-- Waste Dump -->
                    <div>
                        <label for="dumping"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Disposial</label>
                        <select id="dumping" name="dumping_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @if (isset($dumpings) && $dumpings->isNotEmpty())
                            @foreach ($dumpings as $dumping)
                            <option value="{{ $dumping->id }}"
                                {{ old('dumping_id', optional($operasional)->dumping_id) == $dumping->id ? 'selected' : '' }}>
                                {{ $dumping->disposial }}
                            </option>
                            @endforeach
                            @else
                            <option value="">No Disposial available</option>
                            @endif
                        </select>
                    </div>

                    <!-- Material -->
                    <div>
                        <label for="material"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-left">Material</label>
                        <select id="material" name="material_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @if (isset($materials) && $materials->isNotEmpty())
                            @foreach ($materials as $material)
                            <option value="{{ $material->id }}"
                                {{ old('material_id', optional($operasional)->material_id) == $material->id ? 'selected' : '' }}>
                                {{ $material->name }}
                            </option>
                            @endforeach
                            @else
                            <option value="">No materials available</option>
                            @endif
                        </select>
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-end space-x-2 pt-4">
                    <button type="submit" class="text-white m-1 inline-flex items-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        te Data {{$title}}
                    </button>
                    <button type="button" data-modal-toggle="updateProductModal-{{ $operasional->id }}" class="text-red-600 m-1 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" data-modal-hide="defaultModal">
                        <svg class="mr-1 -ml-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
@endforeach