<x-admin.layouts>
    <x-slot:title>{{$title}}</x-slot:title>
    <!-- Header dengan Back Button -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 pb-1 mb-2">
        <h2 class="font-bold text-lg text-white">
            FORM LAPORAN INSIDEN KECELAKAN KERJA
        </h2>
        <a href="{{ route('admin.laporan-user.incident-user.index') }}"
        class="inline-block text-sm text-white bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded-md">
            ← Kembali
        </a>
    </div>

    <!-- Section A - INSIDEN -->
    <div class="border border-white p-4 mb-2">
        <h4 class="font-bold text-lg text-white border-b border-white pb-1 mb-1 uppercase">A. Insiden</h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-4 text-sm text-white">
            <div><span class="font-semibold">Tanggal:</span> {{ date('d-m-Y', strtotime($userReport->incident_date_time)) }}</div>
            <div><span class="font-semibold">Waktu:</span> {{ date('H:i', strtotime($userReport->incident_date_time))}} WITA</div>
            <div><span class="font-semibold">Pekerjaan saat Insiden:</span> {{ $userReport->activity ?? '-' }}</div>
            <div><span class="font-semibold">Jenis Insiden:</span> {{ $userReport->incident_type ?? '-' }}</div>
            <div><span class="font-semibold">Lokasi:</span> {{ $userReport->incident_location }}</div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 mt-2 text-sm text-white">
            <div>
                <div class="font-semibold bg-gray-200 border border-white p-1 text-center text-black">Kronologi Insiden</div>
                <div class="border border-white h-24 p-2 max-h-40 overflow-y-auto whitespace-pre-line">{{ $userReport->incident_description ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Section B - KORBAN -->
    <div class="border border-white p-4 mb-6">
        <h4 class="font-bold text-lg text-white border-b border-white pb-1 mb-1 uppercase">B. Korban</h4>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-y-2 gap-x-4 text-sm text-white">
            <div><span class="font-semibold">Nama:</span> {{ $userReport->victim_name }}</div>
            <div><span class="font-semibold">Usia:</span> {{ $userReport->victim_age ?? '-' }}</div>
            <!-- <div><span class="font-semibold">Bagian/Jabatan:</span> {{ $userreport->victim_position ?? '-' }}</div> -->
            <div><span class="font-semibold">Kategori Cidera:</span> {{ $userReport->injury_category ?? '-' }}</div>
        </div>
    </div>

    <!-- Section C - DOKUMENTASI (FOTO) -->
    <div class="border border-white p-4 mb-2">
        <h4 class="font-bold text-lg text-white border-b border-white pb-1 mb-1 uppercase">C. Dokumentasi Kejadian (Foto)</h4>

        <div class="text-sm text-white">
            <span class="font-semibold">Foto Kejadian saat Insiden:</span>

            @if ($userReport->photos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                @foreach($userReport->photos as $photo)
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
        <h4 class="font-bold text-lg text-white border-b border-white pb-1 mb-1 uppercase">D. Pelaporan</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4 text-sm text-white">
            <div><span class="font-semibold">Nama Pelapor:</span> {{ $userReport->report_by }}</div>
            <div><span class="font-semibold">Tanggal Lapor:</span> {{ date('d-m-Y H:i', strtotime($userReport->report_date_time)) }} WITA</div>
            <div><span class="font-semibold">Kerusakan Aset:</span> {{ $userReport->asset_damage }}</div>
            <div><span class="font-semibold">Dampak Lingkungan:</span> {{ $userReport->environmental_impact }}</div>
        </div>
    </div>
</x-admin.layouts>