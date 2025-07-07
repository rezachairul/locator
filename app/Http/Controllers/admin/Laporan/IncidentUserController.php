<?php

namespace App\Http\Controllers\admin\Laporan;

use App\Models\UserReport;
use App\Models\IncidentUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Exports\IncidentUserExport;
use Illuminate\Support\Facades\Auth;

use App\Notifications\UserReportStatusUpdated;


class IncidentUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Incident User';
        $search = $request->input('search', '');
        $filter = $request->input('filter', 'all');

        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $incident_users = IncidentUser::with('user_report')
            ->when($search, function ($query) use ($keywords) {
                $query->whereHas('user_report', function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->where(function ($qq) use ($word) {
                            $qq->where('victim_name', 'ILIKE', "%{$word}%")
                                ->orWhere('activity', 'ILIKE', "%{$word}%")
                                ->orWhere('incident_type', 'ILIKE', "%{$word}%")
                                ->orWhere('incident_location', 'ILIKE', "%{$word}%")
                                ->orWhere('incident_description', 'ILIKE', "%{$word}%");
                        });
                    }
                });
            })
            ->when($filter != 'all', function ($query) use ($filter) {
                if ($filter == 'today') {
                    $query->whereDate('created_at', \Carbon\Carbon::today());
                } elseif ($filter == 'last_week') {
                    $query->whereBetween('created_at', [
                        \Carbon\Carbon::now()->subWeek()->startOfWeek(),
                        \Carbon\Carbon::now()->subWeek()->endOfWeek(),
                    ]);
                } elseif ($filter == 'last_month') {
                    $query->whereMonth('created_at', \Carbon\Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', \Carbon\Carbon::now()->subMonth()->year);
                }
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.laporan.partials.table_body', compact('title', 'incident_users'))->render();
        }

        return view('admin.laporan.incident-user', compact('title', 'incident_users'));
    }

    public function export(Request $request)
    {
        // dd('Exporting users...');
        $filter = $request->query('filter', 'all'); // mengambil filter dari query string
        $exporter = new IncidentUserExport($filter);
        return $exporter->export();
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,closed',
        ]);

        $incident = IncidentUser::findOrFail($id);

        // Update status di table incident_users
        $incident->status = $request->status;
        $incident->save();

        // Update status di table user_reports
        if ($incident->user_report) {
            $incident->user_report->status = $request->status;
            $incident->user_report->save();
        }

        // Kirim notifikasi ke user pelapor
        $user = $incident->user_report->user ?? null; // relasi user dari laporan
        if ($user) {
            $user->notify(new UserReportStatusUpdated($request->status));
        }

        return back()->with('success', 'Status laporan berhasil diperbarui.');
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
        // Validasi input yang datang
        $request->validate([
            'report_by' => 'required',
            'victim_name' => 'required',
            'incident_type' => 'required',
            'incident_date_time' => 'required|date',
            'incident_location' => 'required',
            'incident_description' => 'required',
            'report_date_time' => 'required|date',
        ]);

        // Simpan data user_report
        $userReport = UserReport::create($request->all());

        // Simpan data incident_user, dengan user_report_id yang baru saja dibuat
        IncidentUser::create([
            'user_report_id' => $userReport->id, // Relasi dengan user_report
        ]);

        // Jika request AJAX, kirim data incident_users terbaru
        if ($request->ajax()) {
            $incident_users = IncidentUser::with('user_report')->get();
            return response()->json([
                'message' => 'User Report Created Successfully',
                'incident_users' => $incident_users,
            ]);
        }

        // Redirect jika bukan request AJAX
        return redirect()->route('user-report.index')->with('success', 'User Report Created Successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(IncidentUser $incidentUser)
    {
        $userReport = $incidentUser->user_report;
        $title = 'Detail Laporan Insiden';

        // Mark as read jika URL di notifikasi cocok
        $url = route('admin.laporan-user.incident-user.show', $incidentUser->id);

        $user = Auth::user(); // Ganti dari auth()->user()

        if ($user) {
            $user->unreadNotifications
                ->where('data.url', $url)
                ->each->markAsRead();
        }

        return view('admin.laporan.show', [
            'incidentUser' => $incidentUser,
            'userReport' => $userReport,
            'title' => $title,
        ]);
    }

    // Bisa pakai view modal seperti di index, atau buat halaman show sendiri.
//     return view('admin.laporan.show', [
//         'title' => 'Laporan Insiden',
//         'user_report' => $userReport,
//     ]);



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncidentUser $incidentUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncidentUser $incidentUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncidentUser $incidentUser)
    {
        //
    }
}