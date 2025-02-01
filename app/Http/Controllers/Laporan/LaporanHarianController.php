<?php

namespace App\Http\Controllers\Laporan;

use App\Models\LaporanHarian;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreLaporanHarianRequest;
use App\Http\Requests\UpdateLaporanHarianRequest;

class LaporanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreLaporanHarianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanHarian $laporanHarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanHarian $laporanHarian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaporanHarianRequest $request, LaporanHarian $laporanHarian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanHarian $laporanHarian)
    {
        //
    }
}
