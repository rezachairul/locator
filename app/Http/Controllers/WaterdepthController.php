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
    public function edit(WaterDepth $waterDepth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaterDepth $waterDepth)
    {
        $request->validate([
            'shift' => 'required|string|max:255',
            'qsv_1' => 'required|numeric',
            'h4' => 'required|numeric',
        ]);
        return redirect()->route('waterdepth.index')->with('success', 'Data update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaterDepth $waterdepth)
    {   
        // dd($waterdepth);
        // // $waterdepth->delete();
        // WaterDepth::destroy($waterdepth->id);

        // dd($waterdepth->id); // Periksa ID yang dihapus
        $waterdepth->delete();

        return redirect()->route('waterdepth.index')->with('Success', 'Data Delete successfully.');
    }
}
