<?php

namespace App\Http\Controllers\Lapangan;

use App\Models\UserReport;
use App\Models\UserReportPhoto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'User Report';
        $user_reports = UserReport::paginate(10);
        return view('lapangan.user_report', compact('title', 'user_reports'));
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
            'incident_type' => 'required',
            'incident_date_time' => 'required',
            'incident_location' => 'required',
            'report_by' => 'required',
            'report_date_time' => 'required',
            'incident_description' => 'required',
            'incident_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        try{
            // Simpan data ke tabel user_reports
            $userReport = UserReport::create([
                'victim_name' => $request->input('victim_name'),
                'incident_type' => $request->input('incident_type'),
                'incident_date_time' => $request->input('incident_date_time'),
                'incident_location' => $request->input('incident_location'),
                'report_by' => $request->input('report_by'),
                'report_date_time' => $request->input('report_date_time'),
                'incident_description' => $request->input('incident_description'),
            ]);

            // Cek dan simpan foto ke tabel user_report_photos
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
            // UserReport::create($request->all());
            return redirect()->route('user-report.index')->with('success', 'User Report Created Successfully');

        } catch (\Exception $e){
            // Handle the exception
            return redirect()->back()->with('error', 'Failed to create User Report: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd($id);
        $user_report = UserReport::findOrFail($id);
        $user_report_photos = UserReportPhoto::where('user_report_id', $id)->get();

        return view('user-report.index', compact('user_report', 'user_report_photos'));

    }

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
        $user_reports->delete();
        return redirect()->route('user-report.index')->with('success', 'User Report Deleted Successfully');
    }
}
