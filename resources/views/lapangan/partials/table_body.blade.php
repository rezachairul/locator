@if ($user_reports->isEmpty())
<tr class="text-gray-700 dark:text-gray-400">
    <td colspan="7" class="px-2 py-1 text-center text-gray-500">
        @if (request()->has('search') && request()->search != '')
            🚨 Laporan {{ $title }} yang dicari nggak ketemu.
        @else
            🚨 Belum ada insiden untuk {{ $title }}.
        @endif
    </td>
</tr>
@else
    @foreach ($user_reports as $key => $user_report)
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm text-center"> {{ $user_reports->firstItem() + $key }} </td>
            <td class="px-4 py-3 text-sm text-center"> {{ $user_report->incident_type }} </td>
            <td class="px-4 py-3 text-sm text-center"> {{ $user_report->incident_date_time }} </td>
            <td class="px-4 py-3 text-sm text-center"> {{ $user_report->incident_location }} </td>
            <!-- Status -->
            <td class="px-2 py-1 text-xs text-center">
                @if ($user_report->status === 'pending')
                <span class="relative group inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-yellow-500 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 
                                                                            hidden group-hover:block bg-black text-white text-[10px] 
                                                                            px-2 py-1 rounded shadow-lg">
                        Pending
                    </div>
                </span>
                @elseif ($user_report->status === 'in_progress')
                <span class="relative group inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500 animate-spin inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 
                                                                            hidden group-hover:block bg-black text-white text-[10px] 
                                                                            px-2 py-1 rounded shadow-lg">
                        In Progress
                    </div>
                </span>
                @elseif ($user_report->status === 'closed')
                <span class="relative group inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 
                                                                            hidden group-hover:block bg-black text-white text-[10px] 
                                                                            px-2 py-1 rounded shadow-lg">
                        Done
                    </div>
                </span>
                @else
                <span class="relative group inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <div class="absolute z-10 bottom-full left-1/2 -translate-x-1/2 mb-1 
                                                                            hidden group-hover:block bg-black text-white text-[10px] 
                                                                            px-2 py-1 rounded shadow-lg">
                        None
                    </div>
                </span>
                @endif
            </td>
            <!-- Actions -->
            <td class="px-2 py-1 text-xs text-center">
                <div class="flex justify-center space-x-2">
                    <!-- Show Details Button -->
                    <button onclick="openModalShow('{{ $user_report->id }}')" class="inline-block text-gray-500 hover:text-blue-600 transition-colors duration-200">
                        <a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </button>
                    <!-- Modal Show Detail -->
                    <div id="modalShow-{{ $user_report->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 overflow-y-auto transition-opacity duration-300 ease-out opacity-0">
                        <div class="relative w-[90%] max-w-5xl mx-auto my-12 transform transition-all duration-300 ease-out scale-95">
                            <div class="bg-white rounded-lg shadow dark:bg-gray-800 overflow-hidden">
                                <!-- Header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        Detail {{ $title }}
                                    </h3>
                                    <button id="closeShowModal-{{ $user_report->id }}" type="button" class="text-gray-400 hover:text-gray-900 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Content -->
                                <div class="p-6 text-sm text-left text-gray-900 dark:text-gray-100 space-y-8 max-h-[85vh] overflow-y-auto">
                                    <div>
                                        <h2 class="font-bold text-lg text-center pb-1 mb-2">FORM LAPORAN KECELAKAN KERJA</h2>
                                    </div>
                                    <!-- Section A - INSIDEN -->
                                    <div class="border border-white p-4 mb-2">
                                        <h4 class="font-bold text-lg border-b border-white pb-1 mb-1 uppercase">A. Insiden</h4>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-y-2 gap-x-4 text-sm">
                                            <div><span class="font-semibold">Tanggal:</span> {{ date('d-m-Y', strtotime($user_report->incident_date_time)) }}</div>
                                            <div><span class="font-semibold">Waktu:</span> {{ date('H:i', strtotime($user_report->incident_date_time))}} WITA</div>
                                            <div><span class="font-semibold">Pekerjaan saat Insiden:</span> {{ $user_report->activity ?? '-' }}</div>
                                            <div><span class="font-semibold">Jenis Insiden:</span> {{ $user_report->incident_type ?? '-' }}</div>
                                            <div><span class="font-semibold">Lokasi:</span> {{ $user_report->incident_location }}</div>
                                        </div>

                                        <div class="grid grid-cols-2 md:grid-cols-1 gap-4 mt-2 text-sm">
                                            <div>
                                                <div class="font-semibold bg-gray-200 border border-white p-1 text-center text-black">Kronologi Insiden</div>
                                                <div class="border border-white h-24 p-2 max-h-40 overflow-y-auto whitespace-pre-line">{{ $user_report->incident_description ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section B - KORBAN -->
                                    <div class="border border-white p-4 mb-6">
                                        <h4 class="font-bold text-lg border-b border-white pb-1 mb-1 uppercase">B. Korban</h4>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-y-2 gap-x-4 text-sm">
                                            <div><span class="font-semibold">Nama:</span> {{ $user_report->victim_name }}</div>
                                            <div><span class="font-semibold">Usia:</span> {{ $user_report->victim_age ?? '-' }}</div>
                                            <!-- <div><span class="font-semibold">Bagian/Jabatan:</span> {{ $user_report->victim_position ?? '-' }}</div> -->
                                            <div><span class="font-semibold">Kategori Cidera:</span> {{ $user_report->injury_category ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <!-- Section C - DOKUMENTASI (FOTO) -->
                                    <div class="border border-white p-4 mb-2">
                                        <h4 class="font-bold text-lg border-b border-white pb-1 mb-1 uppercase">C. Dokumentasi Kejadian (Foto)</h4>

                                        <div class="text-sm">
                                            <span class="font-semibold">Foto Kejadian saat Insiden:</span>

                                            @if ($user_report->photos->count() > 0)
                                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                                                @foreach($user_report->photos as $photo)
                                                <div class="w-full">
                                                    <img src="{{ asset($photo->photo_path) }}"
                                                        alt="Foto Kejadian saat Insiden"
                                                        class="object-cover w-full h-40 border rounded shadow-sm" />
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <p class="italic text-gray-500 mt-2">Belum ada dokumentasi foto.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Section D - Pelaporan -->
                                    <div class="border border-white p-4 mb-2">
                                        <h4 class="font-bold text-lg border-b border-white pb-1 mb-1 uppercase">D. Pelaporan</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4 text-sm">
                                            <div><span class="font-semibold">Nama Pelapor:</span> {{ $user_report->report_by }}</div>
                                            <div><span class="font-semibold">Tanggal Lapor:</span> {{ date('d-m-Y H:i', strtotime($user_report->report_date_time)) }} WITA</div>
                                            <div><span class="font-semibold">Kerusakan Aset:</span> {{ $user_report->asset_damage }}</div>
                                            <div><span class="font-semibold">Dampak Lingkungan:</span> {{ $user_report->environmental_impact }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <button id="editButton-{{$user_report->id}}" class="inline-block text-gray-500 hover:text-yellow-600 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>
                    <!-- Modal Edit ada di bawah form create -->

                    <!-- Delete Button -->
                    <button
                        id="deleteButton-{{$user_report->id}}"
                        data-modal-target="deleteModal-{{$user_report->id}}"
                        data-modal-toggle="deleteModal-{{$user_report->id}}"
                        class="inline-block text-gray-500 hover:text-red-600 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                    <!-- Modals Delete -->
                    <div id="deleteModal-{{$user_report->id}}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                            <!-- Modal content -->
                            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                <button type="button" data-modal-toggle="deleteModal-{{ $user_report->id }}" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                                <div class="flex justify-center items-center space-x-4">
                                    @if (isset($user_report))
                                    <form action="{{ route('operator.user-report.destroy', $user_report->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button data-modal-toggle="deleteModal-{{ $user_report->id }}" type="button" class="mr-2 py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                            No, cancel
                                        </button>
                                        <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            Yes, I'm sure
                                        </button>
                                    </form>
                                    @else
                                    <p>Data Tidak Ditemukan</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
@endif