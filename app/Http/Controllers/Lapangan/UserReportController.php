<?php

namespace App\Http\Controllers\Lapangan;

use App\Models\UserReport;
use App\Models\UserReportPhoto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'User Report';
        $search = $request->input('search', '');

        $user_reports = UserReport::with('photos')
            -> when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('victim_name', 'ILIKE', "%{$search}%")
                        ->orWhere('activity', 'ILIKE', "%{$search}%")
                        ->orWhere('incident_type', 'ILIKE', "%{$search}%")
                        ->orWhere('incident_location', 'ILIKE', "%{$search}%")
                        ->orWhere('incident_description', 'ILIKE', "%{$search}%")
                        ->orWhere('report_by', 'ILIKE', "%{$search}%");
                });
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        // Cek jika request AJAX (biar partial table body aja)
        if ($request->ajax()) {
            return view('lapangan.partials.table_body', compact('title', 'user_reports'))->render();
        }

        return view('lapangan.user-report', compact('title', 'user_reports'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'victim_name' => 'required',
            'victim_age' => 'nullable|integer|min:0',
            'injury_category' => 'required|in:Ringan,Sedang,Berat,Fatal',
            'activity' => 'required',
            'incident_type' => 'required|in:Tertimpa,Tergelincir,Kecelakaan Kendaraan,Jatuh dari Ketinggian,Ledakan,Kebakaran,Lainnya',
            'incident_date_time' => 'required|date',
            'incident_location' => 'required',
            'asset_damage' => 'required|in:Ya,Tidak',
            'environmental_impact' => 'required|in:Ya,Tidak',
            'incident_description' => 'required',
            'report_by' => 'required',
            'report_date_time' => 'required|date',
            'incident_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        try {
            // Simpan data ke tabel user_reports
            $userReport = UserReport::create([
                'victim_name' => $request->input('victim_name'),
                'victim_age' => $request->input('victim_age'),
                'injury_category' => $request->input('injury_category'),
                'activity' => $request->input('activity'),
                'incident_type' => $request->input('incident_type'),
                'incident_date_time' => $request->input('incident_date_time'),
                'incident_location' => $request->input('incident_location'),
                'asset_damage' => $request->input('asset_damage'),
                'environmental_impact' => $request->input('environmental_impact'),
                'incident_description' => $request->input('incident_description'),
                'report_by' => $request->input('report_by'),
                'report_date_time' => $request->input('report_date_time'),
            ]);

            // Cek dan simpan foto ke tabel user_report_photos
            if ($request->hasFile('incident_photo')) {
                foreach ($request->file('incident_photo') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $uniqueName = date('Ymd_His') . '_' . uniqid() . '_' . $originalName;

                    // Simpan file ke storage
                    $file->storeAs('public/image', $uniqueName);

                    // Path relatif agar bisa dipanggil di URL
                    $relativePath = 'storage/image/' . $uniqueName;

                    UserReportPhoto::create([
                        'user_report_id' => $userReport->id,
                        'photo_path' => $relativePath,
                    ]);
                }
            }

            return redirect()->route('user-report.index')->with('success', 'User Report Created Successfully');

        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', 'Failed to create User Report: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     // dd($id);
    //     $user_report = UserReport::with('photos')->findOrFail($id);
    //     return view('user-report.index', compact('user_report'));

    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserReport $userReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        dd($id);
        
        // Cari data berdasarkan ID
        $userReport = UserReport::findOrFail($id);
        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$userReport) {
            return redirect()->route('user-report.index')->with('error', 'Data tidak ditemukan.');
        }
        // Validasi input
        $request->validate([
            'victim_name' => 'required',
            'incident_type' => 'required',
            'incident_date_time' => 'required',
            'incident_location' => 'required',
            'report_by' => 'required',
            'report_date_time' => 'required',
            'incident_description' => 'required',
            'incident_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update data utama user report
        $userReport->update([
            'victim_name' => $request->victim_name,
            'incident_type' => $request->incident_type,
            'incident_date_time' => $request->incident_date_time,
            'incident_location' => $request->incident_location,
            'report_by' => $request->report_by,
            'report_date_time' => $request->report_date_time,
            'incident_description' => $request->incident_description,
        ]);

        // Simpan foto baru jika ada
        if ($request->hasFile('incident_photo')) {
            foreach ($request->file('incident_photo') as $file) {
                $originalName = $file->getClientOriginalName();
                $uniqueName = date('Ymd_His') . '_' . uniqid() . '_' . $originalName;
                $destinationPath = storage_path('app/public/image');
                $file->move($destinationPath, $uniqueName);

                $relativePath = 'storage/image/' . $uniqueName;

                UserReportPhoto::create([
                    'user_report_id' => $userReport->id,
                    'photo_path' => $relativePath,
                ]);
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->route('user-report.index')->with('success', 'User Report Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $user_reports = UserReport::findOrFail($id);
        
        // Cari foto yang terkait dengan user report dan hapus file-nya
        $photos = UserReportPhoto::where('user_report_id', $user_reports->id)->get();
        foreach ($photos as $photo) {
            $relativePath = str_replace('storage/image/', 'image/', $photo->photo_path);
            $filePath = storage_path('app/public/' . $relativePath);
        
            // Coba hapus file dengan unlink()
            if (file_exists($filePath)) {
                try {
                    unlink($filePath);
                    Log::info('File berhasil dihapus dengan unlink(): ' . $filePath);
                } catch (\Exception $e) {
                    Log::error('Gagal menghapus file dengan unlink(): ' . $filePath . ' | Error: ' . $e->getMessage());
                }
            } else {
                // Fallback: hapus pakai Storage facade
                $storagePath = 'public/' . $relativePath;
                if (Storage::exists($storagePath)) {
                    Storage::delete($storagePath);
                    Log::info('File dihapus dengan Storage::delete(): ' . $storagePath);
                } else {
                    Log::warning('File tidak ditemukan untuk dihapus: ' . $filePath);
                }
            }
        
            // Hapus data dari database
            $photo->delete();
        }

        $user_reports->delete();
        return redirect()->route('user-report.index')->with('success', 'User Report Deleted Successfully');
    }
}
