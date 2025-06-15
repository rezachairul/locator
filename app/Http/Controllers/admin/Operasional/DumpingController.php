<?php

namespace App\Http\Controllers\admin\Operasional;

use App\Models\Dumping;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DumpingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Waste Dump';
        // Ambil data Dumpings
        // $dumpings = Dumping::all();        
        
        // Filter data untuk reset pukul 00.00
        $dumpings = Dumping::whereDate('created_at', now()->toDateString())
        ->orderBy('id', 'asc')
        ->paginate(10);

        return view('operasional/dumping/dumping', compact('title', 'dumpings'));
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
            'disposial' => 'required',
            'easting' => 'required|numeric|between:0,999999.999999',
            'northing' => 'required|numeric|between:0,999999.999999',
            'elevation_rl' => 'required|numeric|between:0,999.99',
            'elevation_actual' => 'required|numeric|between:0,999.99',
        ]);
        Dumping::create([
            'disposial' => $request->disposial,
            'easting' => $request->easting,
            'northing' => $request->northing,
            'elevation_rl' => $request->elevation_rl,
            'elevation_actual' => $request->elevation_actual,
        ]);
        
        return redirect()->route('dumping.index')->with('succes', 'Data added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dumping $dumping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dumping $dumping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        // Mencari model berdasarkan ID
        $dumping = Dumping::find($id);

        // Cek jika data ditemukan
        if (!$dumping) {
            return redirect()->route('dumping.index')->with('error', 'Data updated successfully.');
        }

        // Validasi input
        $request->validate([
            'disposial' => 'required',
            'easting' => 'required | numeric',
            'northing' => 'required | numeric',
            'elevation_rl' => 'required|numeric',
            'elevation_actual' => 'required|numeric',
        ]);
        
        // Update data
        $dumping->update([
            'disposial' => $request->disposial,
            'easting' => $request->easting,
            'northing' => $request->northing,
            'elevation_rl' => $request->elevation_rl,
            'elevation_actual' => $request->elevation_actual,
        ]);

        return redirect()->route('dumping.index')->with('error', 'Update data successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $dumping = Dumping::findOrFail($id);
        $dumping->delete();
        return redirect()->route('dumping.index')->with('success', 'Item deleted successfully.');
    }
}
