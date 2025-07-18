<?php

namespace App\Http\Controllers\Lapangan;

use App\Models\User;
use App\Models\UserReport;
use App\Models\IncidentUser;
use Illuminate\Http\Request;
use App\Models\UserReportPhoto;
use App\Exports\UserReportsExport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\UserReportNotification;

class UserReportController extends Controller
{

    public function index(Request $request)
    {
        $title = 'User Report';
        $search = $request->input('search', '');

        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];
        
        $user_reports = UserReport::with('photos')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('victim_name', 'ILIKE', "%{$search}%")
                        ->orWhere('activity', 'ILIKE', "%{$search}%")
                        ->orWhere('incident_type', 'ILIKE', "%{$search}%")
                        ->orWhere('incident_location', 'ILIKE', "%{$search}%")
                        ->orWhere('incident_description', 'ILIKE', "%{$search}%")
                        ->orWhere('report_by', 'ILIKE', "%{$search}%");
                });
            })
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->orderBy('id', 'asc')
            ->paginate(10);


        // Cek jika request AJAX (biar partial table body aja)
        if ($request->ajax()) {
            return view('lapangan.partials.table_body', compact('title', 'user_reports'))->render();
        }

        // Tandai semua notif user sebagai sudah dibaca
        $user = Auth::user();

        if ($user) {
            $user->unreadNotifications
                ->each->markAsRead();
        }

        return view('lapangan.user-report', compact('title', 'user_reports'));
    }

    public function export()
    {
        // dd('Exporting users...');
        $export = new UserReportsExport();
        return $export->export();
    }

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

            // Cek apakah user login
            $userId = Auth::check() ? Auth::id() : null;
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
                'user_id' => $userId,
            ]);

            // Cek dan simpan foto ke tabel user_report_photos
            if ($request->hasFile('incident_photo')) {
                foreach ($request->file('incident_photo') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $filename = pathinfo($originalName, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();

                    // Sanitize nama file: hanya huruf, angka, underscore, dash. Ganti lainnya jadi dash
                    $filename_sanitized = preg_replace('/[^A-Za-z0-9_\-]/', '-', $filename);

                    // Buat nama file unik
                    $uniqueName = date('Ymd_His') . '_' . uniqid() . '_' . $filename_sanitized . '.' . $extension;

                    // Simpan file ke storage
                    $file->storeAs('/uploads/images', $uniqueName);
                    
                    // Path relatif agar bisa dipanggil di URL
                    $relativePath = 'storage/uploads/images/' . $uniqueName;

                    UserReportPhoto::create([
                        'user_report_id' => $userReport->id,
                        'photo_path' => $relativePath,
                    ]);
                }
            }
            
            // 🔔 Kirim notifikasi ke admin
            $admins = User::where('role', 'admin')->get();

            foreach ($admins as $admin) {
                $admin->notify(new UserReportNotification($userReport));
            }

            // Hindari duplikat jika sudah ada
            IncidentUser::firstOrCreate([
                'user_report_id' => $userReport->id
            ]);

            return redirect()->route('operator.user-report.index')->with('success', 'User Report Created Successfully');

        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', 'Failed to create User Report: ' . $e->getMessage());
        }
    }

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
                $destinationPath = storage_path('app/public/uploads/images');
                $file->move($destinationPath, $uniqueName);

                $relativePath = 'storage/uploads/images/' . $uniqueName;

                UserReportPhoto::create([
                    'user_report_id' => $userReport->id,
                    'photo_path' => $relativePath,
                ]);
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->route('operator.user-report.index')->with('success', 'User Report Updated Successfully');
    }

    public function destroy($id)
    {
        // dd($id);
        $user_reports = UserReport::findOrFail($id);
        
        // Cari foto yang terkait dengan user report dan hapus file-nya
        $photos = UserReportPhoto::where('user_report_id', $user_reports->id)->get();
        foreach ($photos as $photo) {
            $relativePath = str_replace('storage/uploads/images/', 'uploads/images/', $photo->photo_path);
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
        return redirect()->route('operator.user-report.index')->with('success', 'User Report Deleted Successfully');
    }
}
