<?php

namespace App\Http\Controllers;

use App\Models\WaterDepth;
use Illuminate\Http\Request;

class WaterdepthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Water Depth';
        $waterdepths = Waterdepth::all();

        // Filter data untuk hanya yang berumur 24 jam terakhir
        // $waterdepths = WaterDepth::where('created_at', '>=', now()->subDay())
        // ->orderBy('id', 'asc')
        // ->get();

        // Filter data untuk reset pukul 00.00
        $waterdepths = WaterDepth::whereDate('created_at', now()->toDateString())
        ->orderBy('id', 'asc')
        ->get();

        return view('waterdepth/waterdepth', compact('title', 'waterdepths'));
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
        $request->validate([
            'shift' => 'required|string|max:255',
            'qsv_1' => 'required|numeric',
            'h4' => 'required|numeric',
        ]);
        WaterDepth::create([
            'shift' => $request->shift,
            'qsv_1' => $request->qsv_1,
            'h4' => $request->h4,
        ]);
        return redirect()->route('waterdepth.index')->with('success', 'Data added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WaterDepth $waterDepth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }    

    public function update(Request $request, $id)
    {
        // Mencari model berdasarkan ID
        $waterDepth = WaterDepth::find($id);

        // Cek jika data tidak ditemukan
        if (!$waterDepth) {
            return redirect()->route('waterdepth.index')->with('error', 'Data not found');
        }

        // Validasi input
        $request->validate([
            'shift' => 'required|string|max:255',
            'qsv_1' => 'required|numeric',
            'h4' => 'required|numeric',
        ]);
        
        // Update data 
        $waterDepth->update([
            'shift' => $request->shift,
            'qsv_1' => $request->qsv_1,
            'h4' => $request->h4,
        ]);

        return redirect()->route('waterdepth.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    { 
        // dd($id);
        $waterdepth = WaterDepth::findOrFail($id);
        $waterdepth->delete();
        return redirect()->route('waterdepth.index')->with('Success', 'Data Delete successfully.');
    }
}
