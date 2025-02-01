<?php

namespace App\Http\Controllers\Operasional;

use App\Models\Exca;
use App\Models\Dumping;
use App\Models\Material;
use App\Exports\ExcasExport;
use App\Imports\ExcasImport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;



class ExcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Load Point';
        $excas = Exca::all();
        
        // Filter data untuk reset pukul 00.00
        $excas = Exca::whereDate('created_at', now()->toDateString())
        ->orderBy('id', 'asc')
        ->get();

        // Mapping untuk label
        $pitLabels = [
            'qsv1s' => 'QSV1S',
            'qsv3' => 'QSV3'
        ];

        $loadingUnitLabels = [
            'fex400_441' => 'FEX400-441',
            'fex400_419' => 'FEX400-419',
            'fex400_449' => 'FEX400-449',
            'fex400_454' => 'FEX400-454',
            'fex400_456' => 'FEX400-456'
        ];


        foreach ($excas as $exca) {
            $exca->pit_label = $pitLabels[$exca->pit] ?? $exca->pit;
            $exca->loading_unit_label = $loadingUnitLabels[$exca->loading_unit] ?? $exca->loading_unit;
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

        // Ambil data Waste Dump
        $dumpings = Dumping::all();
        // Filter dumpings berdasarkan tanggal hari ini
        $dumpings = Dumping::whereDate('created_at', now()->toDateString())->get();
        if ($dumpings->isEmpty()) {
            $dumpings = collect([
                (object) ['id' => '', 'disposial_label' => 'No Waste Dump available']
            ]);
        }


        return view('operasional.exca.excavator', compact('title', 'excas', 'dumpings', 'materials'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // dd($request->all()); 
        $request->validate([
            'pit' => 'required|in:qsv1s,qsv3',
            'loading_unit' => 'required|in:fex400_441,fex400_419,fex400_449,fex400_454,fex400_456',
            'dumping_id' => 'required|exists:dumpings,id',
            'easting' => 'required|numeric',
            'northing' => 'required|numeric',
            'elevation_rl' => 'required|numeric',
            'elevation_actual' => 'required|numeric',
            'front_width' => 'required|numeric',
            'front_height' => 'required|numeric',
            'material_id' => 'required|exists:materials,id',
            'dop' => 'required',
        ]);        

        Exca::create([
            'pit' => $request->pit,
            'loading_unit' => $request->loading_unit,
            'dumping_id' => $request->dumping_id,
            'easting' => str_replace(',', '.', $request->easting),
            'northing' => str_replace(',', '.', $request->northing),
            'elevation_rl' => $request->elevation_rl,
            'elevation_actual' => $request->elevation_actual,
            'front_width' => $request-> front_width,
            'front_height' => $request-> front_height,
            'material_id' => $request->material_id,
            'dop' => $request->dop,
        ]);

        return redirect()->route('exca.index')->with('success', 'Berhasil Tambah Data Excavator');
    }

    public function show(exca $exca)
    {
        //
    }

    public function edit($id)
    {
        //
    }    
    

    public function update(Request $request, $id)
    {
        $exca = Exca::find($id);

        // Cek jika data ditemukan
        if (!$exca) {
            return redirect()->route('exca.index')->with('error', 'Data Excavator tidak ditemukan');
        }

        // Validasi input
        $request->validate([
            'pit' => 'required|in:qsv1s,qsv3',
            'loading_unit' => 'required|in:fex400_441,fex400_419,fex400_449,fex400_454,fex400_456',
            'dumping_id' => 'required|exists:dumpings,id',
            'easting' => 'required|numeric',
            'northing' => 'required|numeric',
            'elevation_rl' => 'required|numeric',
            'elevation_actual' => 'required|numeric',
            'front_width' => 'required|numeric',
            'front_height' => 'required|numeric',
            'material_id' => 'required|exists:materials,id',
            'dop' => 'required',
        ]);


        // Validate input update
        $easting = str_replace(',', '.', $request->easting);
        $northing = str_replace(',', '.', $request->northing);


        // Update data
        $exca->update([
            'pit' => $request->pit,
            'loading_unit' => $request->loading_unit,
            'dumping_id' => $request->dumping_id,
            'easting' => $easting,
            'northing' => $northing,
            'elevation_rl' => $request->elevation_rl,
            'elevation_actual' => $request->elevation_actual,
            'front_width' => $request-> front_width,
            'front_height' => $request-> front_height,
            'material_id' => $request->material_id,
            'dop' => $request->dop,
        ]);

        return redirect()->route('exca.index')->with('success', 'Data Excavator berhasil diperbarui');
    }

    public function destroy($id)
    {
        // dd($id);
        $exca = Exca::findOrFail($id);
        $exca->delete();
        return redirect()->route('exca.index')->with('success', 'Item deleted successfully.');
    }

    // EXPORT dan IMPORT FILE
    //Export
    public function export ()
    {
        $data = Exca::with(['dumping', 'material'])->get();
        // dd($data->toArray());

        // Pastikan memberikan data ke constructor
        $export = new ExcasExport($data);
        return $export->export();
    }
    public function import (Request $request)
    {
        // dd($request->all()); 
        // Validasi file upload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Hanya menerima file Excel/CSV
        ]);
        try {
            // Ambil file yang diupload
            $file = $request->file('file');
            
            // Tentukan lokasi penyimpanan
            $path = $file->storeAs('imports', $file->getClientOriginalName());
            
            // dd($file, $path);
            // Mengimpor file menggunakan ExcasImport
            Excel::import(new ExcasImport, $file);
    
            // Jika sukses, redirect ke 'exca.index' dengan pesan sukses
            return redirect()->route('exca.index')->with('success', 'Data berhasil diimpor!');
        }
        catch (\Exception $e) {
            // Tangani error jika terjadi
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengimpor data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
