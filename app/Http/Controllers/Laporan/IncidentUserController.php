<?php

namespace App\Http\Controllers\Laporan;

use App\Models\IncidentUser;
use App\Models\UserReport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class IncidentUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Incident User';
        $search = $request->input('search');

        $incident_users = IncidentUser::with('user_report')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user_report', function ($q) use ($search) {
                    $q->where('victim_name', 'like', "%{$search}%")
                    ->orWhere('activity', 'like', "%{$search}%")
                    ->orWhere('incident_type', 'like', "%{$search}%")
                    ->orWhere('incident_location', 'like', "%{$search}%")
                    ->orWhere('incident_description', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('laporan.partials.table_body', compact('title', 'incident_users'))->render();
        }

        return view('laporan.incident-user', compact('title', 'incident_users'));
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
        //
    }

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