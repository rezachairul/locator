<?php

namespace App\Http\Controllers;

use App\Models\Exca;
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
        $title = 'Dumping Point';
        $dumpings = Dumping::all();

        $disLabels = [
            'ipdsidewallutara' => 'IPD Sidewall Utara',
            'ss3' => 'SS3',
        ];

        foreach($dumpings as $dumping){
            $dumping->disposial_label = $disLabels[$dumping->disposial_attribute] ?? $dumping->disposial_attribute;
        }
        return view('dumping/dumping', compact('title', 'dumpings'));
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
            'disposial' => 'required | in:ipdsidewallutara,ss3',
            'easting' => 'required | numeric',
            'northing' => 'required | numeric',
            'elevation_rl' => 'required|numeric',
            'elevation_actual' => 'required|numeric',
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
    public function update(Request $request, Dumping $dumping)
    {
        //
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
