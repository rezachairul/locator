<?php

namespace App\Http\Controllers\Operasional;

use App\Models\Exca;
use App\Models\Dumping;
use App\Models\Weather;
use App\Models\Material;
use App\Models\Waterdepth;
use App\Models\Operasional;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Operasional';
        $operasionals = Operasional::orderBy('id', 'asc')->paginate(10);

        // Ambil data Exca
        $excas = Exca::all();
        // Filter excas berdasarkan tanggal hari ini
        $excas = Exca::whereDate('created_at', now()->toDateString())->get();
        if ($excas->isEmpty()) {
            $excas = collect([
                (object) ['id' => '', 'loading_unit' => 'No Loading Unit available']
            ]);
        }

        // Ambil data Waste Dump
        $dumpings = Dumping::all();
        // Filter dumpings berdasarkan tanggal hari ini
        $dumpings = Dumping::whereDate('created_at', now()->toDateString())->get();
        if ($dumpings->isEmpty()) {
            $dumpings = collect([
                (object) ['id' => '', 'disposial' => 'No Disposial available']
            ]);
        }

        // Ambil data materials
        $materials = Material::whereDate('created_at', now()->toDateString())->get();
        // Jika tidak ada data untuk hari ini, ambil semua data dari tabel Material
        if ($materials->isEmpty()) {
            $materials = Material::all();
        }
        // Jika tabel benar-benar kosong, tambahkan data dummy sebagai fallback
        if ($materials->isEmpty()) {
            $materials = collect([
                (object) ['id' => '', 'name' => 'No materials available']
            ]);
        }
        
        $today = now()->startOfDay();
        // Ambil data weather dan Waterdepth
        $latestWeather = Weather::where('created_at', '>=', $today)->latest()->first();
        $latestWaterDepth = Waterdepth::where('created_at', '>=', $today)->latest()->first();

        return view('operasional.operasional.operasional', compact('title', 'operasionals', 'excas', 'dumpings', 'materials', 'latestWeather', 'latestWaterDepth'));
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
        // dd ($request->all());
        $request->validate([
            'pit' => 'required',
            'loading_unit_id' => 'required|exists:excas,id',
            'dop' => 'required',
            'dumping_id' => 'required|exists:dumpings,id',
            'material_id' => 'required|exists:materials,id',
        ]);
        
        Operasional::create([
            'pit' => $request->pit,
            'loading_unit_id' => $request->loading_unit_id,
            'dop' => $request->dop,
            'dumping_id' => $request->dumping_id,
            'material_id' => $request->material_id,
        ]);
        return redirect()->route('operasional.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Operasional $operasional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Operasional $operasional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Operasional $operasional)
    {
        dd ($request->all());
        $request->validate([
            'pit' => 'required',
            'loading_unit_id' => 'required|exists:excas,id',
            'dop' => 'required',
            'dumping_id' => 'required|exists:dumpings,id',
            'material_id' => 'required|exists:materials,id',
        ]);
        Operasional::where('id', $operasional->id)->update([
            'pit' => $request->pit,
            'loading_unit_id' => $request->loading_unit_id,
            'dop' => $request->dop,
            'dumping_id' => $request->dumping_id,
            'material_id' => $request->material_id,
        ]);
        return redirect()->route('operasional.index')->with('success', 'Berhasil Update Data Operasional');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $operasional = Operasional::findOrFail($id);
        $operasional->delete();
        return redirect()->route('operasional.index')->with('success', 'Item deleted successfully.');

    }
}
