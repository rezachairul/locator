<?php

namespace App\Http\Controllers;

use App\Models\Exca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ExcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Excavator';
        $excas = Exca::all();

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

        $materialLabels = [
            's' => 'S',
            'm' => 'M',
            'c' => 'C',
            'b' => 'B',
            'nb' => 'NB',
            'otr' => 'OTR'
        ];

        foreach ($excas as $exca) {
            $exca->pit_label = $pitLabels[$exca->pit] ?? $exca->pit;
            $exca->loading_unit_label = $loadingUnitLabels[$exca->loading_unit] ?? $exca->loading_unit;
            $exca->material_label = $materialLabels[$exca->material] ?? $exca->material;
        }

        //Menambahkan pengurutan berdasarkan 'id' secara ascending
        $excas = Exca::orderBy('id', 'asc')->get();

        return view('exca/excavator', compact('title', 'excas'));
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
            'easting' => 'required|numeric',
            'northing' => 'required|numeric',
            'elevation_rl' => 'required|numeric',
            'elevation_actual' => 'required|numeric',
            'material' => 'required|in:s,m,c,b,nb,otr',
            'dop' => 'required',
        ]);        

        Exca::create([
            'pit' => $request->pit,
            'loading_unit' => $request->loading_unit,
            'easting' => $request->easting,
            'northing' => $request->northing,
            'elevation_rl' => $request->elevation_rl,
            'elevation_actual' => $request->elevation_actual,
            'material' => $request->material,
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
        // Mengambil data Excavator berdasarkan ID, jika tidak ditemukan akan melemparkan 404 error
        // $exca = Exca::findOrFail($id);
        // dd($exca);
        // $title = 'Edit Excavator';

        // // Mengirimkan variabel $exca dan $title ke view 'exca.update'
        // return view('exca.update', compact('exca', 'title'));
    }    
    

    public function update(Request $request, $id)
    {
        // dd($request->all());

        // Mencari model berdasarkan ID
        $exca = Exca::find($id);

        // Cek jika data ditemukan
        if (!$exca) {
            return redirect()->route('exca.index')->with('error', 'Data Excavator tidak ditemukan');
        }


        // Validasi input
        $request->validate([
            'pit' => 'required|in:qsv1s,qsv3',
            'loading_unit' => 'required|in:fex400_441,fex400_419,fex400_449,fex400_454,fex400_456',
            'easting' => 'required|numeric',
            'northing' => 'required|numeric',
            'elevation_rl' => 'required|numeric',
            'elevation_actual' => 'required|numeric',
            'material' => 'required|in:s,m,c,b,nb,otr',
            'dop' => 'required',
        ]);

        // Update data
        $exca->update([
            'pit' => $request->pit,
            'loading_unit' => $request->loading_unit,
            'easting' => $request->easting,
            'northing' => $request->northing,
            'elevation_rl' => $request->elevation_rl,
            'elevation_actual' => $request->elevation_actual,
            'material' => $request->material,
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

}
