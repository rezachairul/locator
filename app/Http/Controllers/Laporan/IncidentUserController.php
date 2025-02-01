<?php

namespace App\Http\Controllers\Laporan;

use App\Models\IncidentUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class IncidentUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Laporan Incident User';
        // $incident_users = IncidentUser::all();
        return view('laporan.incident-user', compact('title'));
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
        //
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
