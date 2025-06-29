<x-operator.layouts :title="$title" :hideSidebar="true">
    <div class="m-5">
        <!-- Header -->
        <div class="flex justify-between items-center mb-2">
            <div>
                <x-operator.header>{{$title}}</x-operator.header>
            </div>
            <div class="text-right">
                <ol class="breadcrumb inline-flex space-x-2">
                    <li class="breadcrumb-item">
                        <a href="/operator" class="text-blue-500 hover:text-blue-700">Operasional Lapangan</a>
                    </li>
                    <li class="breadcrumb-item active text-gray-500"> / </li>
                    <li class="breadcrumb-item active text-gray-500">{{$title}}</li>
                </ol>
            </div>
        </div>
    
        <!-- Form Create Report User -->
        <div id="createForm" class="hidden p-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Form Tambah {{$title}}
                </h3>
                <button type="button" id="exitButton" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form id="reportForm" action="{{route('operator.user-report.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 mt-4 sm:grid-cols-2">
    
                    <!-- Nama Korban -->
                    <div>
                        <label for="victim_name" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Nama Korban
                        </label>
                        <input type="text" id="victim_name" name="victim_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Masukkan nama korban" required>
                    </div>
    
                    <!-- Usia Korban -->
                    <div>
                        <label for="victim_age" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Usia Korban
                        </label>
                        <input type="number" id="victim_age" name="victim_age" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Masukkan usia korban">
                    </div>
    
                    <!-- Kategori Cedera -->
                    <div>
                        <label for="injury_category" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Kategori Cedera
                        </label>
                        <select id="injury_category" name="injury_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">Pilih Kategori Cedera</option>
                            <option value="Ringan">Ringan (dapat segera kembali bekerja)</option>
                            <option value="Sedang">Sedang (butuh P3K/fasilitas kesehatan)</option>
                            <option value="Berat">Berat (rawat inap/rujukan RS)</option>
                            <option value="Fatal">Fatal (cacat permanen/meninggal dunia)</option>
                        </select>
                    </div>
    
                    <!-- Pekerjaan / Aktivitas Saat Insiden -->
                    <div>
                        <label for="activity" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Pekerjaan Saat Insiden
                        </label>
                        <input type="text" id="activity" name="activity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Misal: Mengoperasikan loader" required>
                    </div>
    
                    <!-- Lokasi Insiden -->
                    <div>
                        <label for="incident_location" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Lokasi Insiden
                        </label>
                        <input type="text" id="incident_location" name="incident_location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Contoh: Pit A, Hauling Road, Workshop" required>
                    </div>
    
                    <!-- Jenis Insiden -->
                    <div>
                        <label for="incident_type" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Jenis Insiden
                        </label>
                        <select id="incident_type" name="incident_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">Pilih Jenis Insiden</option>
                            <option value="Tertimpa">Tertimpa</option>
                            <option value="Tergelincir">Tergelincir</option>
                            <option value="Kecelakaan Kendaraan">Kecelakaan Kendaraan</option>
                            <option value="Jatuh dari Ketinggian">Jatuh dari Ketinggian</option>
                            <option value="Ledakan">Ledakan</option>
                            <option value="Kebakaran">Kebakaran</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
    
                    <!-- Tanggal dan Waktu Insiden -->
                    <div>
                        <label for="incident_date_time" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Tanggal dan Waktu Insiden
                        </label>
                        <input type="datetime-local" id="incident_date_time" name="incident_date_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
    
                    <!-- Ada Kerusakan Aset? -->
                    <div>
                        <label for="asset_damage" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Ada Kerusakan Aset?
                        </label>
                        <select id="asset_damage" name="asset_damage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">Pilih</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
    
                    <!-- Ada Dampak Lingkungan? -->
                    <div>
                        <label for="environmental_impact" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Ada Dampak Lingkungan?
                        </label>
                        <select id="environmental_impact" name="environmental_impact" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">Pilih</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
    
                    <!-- Deskripsi Kronologi -->
                    <div class="sm:col-span-2">
                        <label for="incident_description" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Deskripsi Kronologi Insiden
                        </label>
                        <textarea id="incident_description" name="incident_description" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Ceritakan kronologi singkat insiden" required></textarea>
                    </div>
    
                    <!-- Upload Bukti Foto -->
                    <div>
                        <label for="incident_photo" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Upload Bukti Foto
                        </label>
    
                        <!-- Preview Container -->
                        <div id="imgPreviewContainer" class="grid grid-cols-3 gap-3 mb-2"></div>
    
                        <!-- Input File -->
                        <div id="inputContainer">
                            <input type="file" name="incident_photo[]" multiple="false"
                                onchange="handleSingleImage(event)"
                                accept="image/*"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                                    dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Format: JPG, PNG, dll. Maks 2MB per gambar.</p>
                    </div>
    
                    <!-- Nama Pelapor -->
                    <div>
                        <label for="report_by" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Nama Pelapor
                        </label>
                        <input type="text" id="report_by" name="report_by" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Masukkan nama pelapor" required>
                    </div>
    
                    <!-- Tanggal dan Waktu Pelaporan -->
                    <div>
                        <label for="report_date_time" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Tanggal dan Waktu Pelaporan
                        </label>
                        <input type="datetime-local" id="report_date_time" name="report_date_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                </div>
    
                <!-- Tombol Simpan dan Batal -->
                <div class="flex justify-end space-x-2 pt-4">
                    <button type="submit" id="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new Data {{ $title }}
                    </button>
                    <button type="button" id="cancelButton"
                        class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        <svg class="mr-1 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    
        <!-- Form Edit Report User -->
        @foreach ($user_reports as $key => $user_report)
        <div id="editForm-{{ $user_report->id }}" class="hidden p-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Form Edit {{$title}}
                </h3>
                <button type="button" id="closeEditButton-{{ $user_report->id }}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form id="editFormReport" action="{{route('operator.user-report.update', $user_report->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 mt-4 sm:grid-cols-2">
                    <!-- Victim Name -->
                    <div>
                        <label for="victim_name" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">Nama Korban</label>
                        <input type="text" id="victim_name" name="victim_name" value="{{ old('victim_name', $user_report->victim_name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Nama korban yang mengalami insiden" required>
                    </div>
                    <!-- Incident Type -->
                    <div>
                        <label for="incident_type" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">Jenis Insiden</label>
                        <input type="text" id="incident_type" name="incident_type" value="{{ old('incident_type', $user_report->incident_type) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Jenis incident (misalnya: kecelakaan, cedera, dll.)" required>
                    </div>
                    <!-- Incident Location -->
                    <div>
                        <label for="incident_location" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">Lokasi Insiden</label>
                        <input type="text" id="incident_location" name="incident_location" value="{{ old('incident_location', $user_report->incident_location) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder=" Lokasi kejadian incident" required>
                    </div>
                    <!-- Incident Date and Time -->
                    <div>
                        <label for="incident_date_time" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">Tanggal dan Waktu Insiden</label>
                        <input type="datetime-local" id="incident_date_time" name="incident_date_time" value="{{ old('incident_date_time', $user_report->incident_date_time) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <!-- Report by -->
                    <div>
                        <label for="report_by" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">Dilaporkan Oleh</label>
                        <input type="text" id="report_by" name="report_by" value="{{ old('report_by', $user_report->report_by) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Nama Pelapor incident" required>
                    </div>
                    <!-- Report Date and Time -->
                    <div>
                        <label for="report_date_time" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">Tanggal dan Waktu Pelaporan</label>
                        <input type="datetime-local" id="report_date_time" name="report_date_time" value="{{ old('report_date_time', $user_report->report_date_time) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <!-- Incident Description -->
                    <div>
                        <label for="incident_description" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">Deskripsi Insiden</label>
                        <textarea id="incident_description" name="incident_description" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Deskripsi singkat tentang incident" required>{{ old('incident_description', $user_report->incident_description) }}</textarea>
                    </div>
                    <!-- Incident Photo di Form Edit -->
                    <div>
                        <label class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
                            Upload Bukti Foto
                        </label>
    
                        <!-- Preview Container untuk foto baru -->
                        <div id="imgEditPreviewContainer-{{ $user_report->id }}" class="flex flex-wrap gap-2 mb-2"></div>
    
                        <!-- Container untuk input file -->
                        <div id="inputEditContainer-{{ $user_report->id }}">
                            <input type="file" name="incident_photo[]" multiple="false"
                                onchange="handleSingleImageEdit(event, '{{ $user_report->id }}')"
                                accept="image/*"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                                    dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>
    
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Format: JPG, PNG, maksimal 2MB per gambar.</p>
                    </div>
                </div>
    
                <!-- Tombol Simpan dan Batal -->
                <div class="flex justify-end space-x-2 pt-4">
                    <button type="submit" id="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Edit Data {{ $title }}
                    </button>
                    <button type="button" id="cancelEditButton-{{ $user_report->id }}"
                        class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        <svg class="mr-1 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Cancel
                    </button>
                </div>
            </form>
        </div>
        @endforeach
    
        <!-- Tabel Data User Report -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="flex items-center justify-between flex-wrap gap-2 p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">
                <!-- Bagian Pencarian -->
                <div class="flex flex-1 lg:mr-32">
                    <div class="relative w-full max-w-xl">
                        <!-- Ikon Search di kiri -->
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>

                        <!-- Input -->
                        <input id="search-input" type="text"
                            value="{{ request('search') }}"
                            data-url="{{ route('operator.user-report.index') }}"
                            data-target="user-report-tbody"
                            class="w-full pl-8 pr-8 text-sm text-gray-100 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-400 dark:bg-gray-700 focus:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:bg-white dark:focus:bg-gray-600 focus:border-purple-300 focus:outline-none form-input"
                            placeholder="Search for {{ $title }}..." />

                        <!-- Ikon Refresh di kanan -->
                        <div id="refresh-button" class="absolute inset-y-0 right-0 flex items-center pr-2 cursor-pointer" onclick="location.reload()">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Bagian Tombol -->
                <div class="flex gap-2">
                    <!-- Tombol Create -->
                    <button id="createButton" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Create
                    </button>
                    <!-- Tombol Export -->
                    <button type="button" class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3.5 w-3.5 mr-2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Export
                    </button>
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3 text-center" rowspan="2">No</th>
                            <th class="px-4 py-3 text-center" rowspan="2">Incident Type</th>
                            <th class="px-4 py-3 text-center" rowspan="2">Incident Date and Time</th>
                            <th class="px-4 py-3 text-center" rowspan="2">Incident Location</th>
                            <th class="px-4 py-3 text-center" rowspan="2">Status</th>
                            <th class="px-4 py-3 text-center" rowspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="user-report-tbody" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @include('lapangan.partials.table_body')
                    </tbody>
                </table>
            </div>
            <!-- Pagination & Showing -->
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <!-- Showing -->
                <span class="flex items-center col-span-3">
                    Showing {{$user_reports->firstItem()}} - {{$user_reports->lastItem()}} of {{ $user_reports->total() }} Entries
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <div class="col-span-4 flex items-center justify-end space-x-2">
                    @if ($user_reports->onFirstPage())
                    <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Previous</span>
                    @else
                    <a href="{{ $user_reports->previousPageUrl() }}" class="px-4 py-2 text-gray-300 bg-gray-800 border border-gray-600 rounded-md hover:bg-gray-700">Previous</a>
                    @endif
                    <span class="text-gray-300">Page {{ $user_reports->currentPage() }} of {{ $user_reports->lastPage() }}</span>
                    @if ($user_reports->hasMorePages())
                    <a href="{{ $user_reports->nextPageUrl() }}" class="px-4 py-2 text-gray-300 bg-gray-800 border border-gray-600 rounded-md hover:bg-gray-700">Next</a>
                    @else
                    <span class="px-4 py-2 text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        function openModalShow(id) {
            const modal = document.getElementById(`modalShow-${id}`);
            if (modal) {
                modal.classList.remove('hidden', 'opacity-0');
                modal.classList.add('block', 'opacity-100');
            }
        }

        document.querySelectorAll("[id^='closeShowModal-']").forEach(button => {
            button.addEventListener('click', function() {
                const id = this.id.replace('closeShowModal-', '');
                const modal = document.getElementById(`modalShow-${id}`);
                if (modal) {
                    modal.classList.remove('block', 'opacity-100');
                    modal.classList.add('hidden', 'opacity-0');
                }
            });
        });
        </script>

</x-operator.layouts>