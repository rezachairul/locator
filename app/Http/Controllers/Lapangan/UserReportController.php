<?php

namespace App\Http\Controllers\Lapangan;

use App\Models\UserReport;
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
            'report_by' => 'required',
            'victim_name' => 'required',
            'incident_type' => 'required',
            'incident_date_time' => 'required',
            'incident_location' => 'required',
            'incident_description' => 'required',
            'report_date_time' => 'required',
        ]);
        UserReport::create($request->all());
        return redirect()->route('user-report.index')->with('success', 'User Report Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserReport $userReport)
    {
        //
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
    public function update(Request $request, UserReport $userReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserReport $userReport)
    {
        //
    }
}
