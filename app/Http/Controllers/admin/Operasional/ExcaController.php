<?php

namespace App\Http\Controllers\admin\Operasional;

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
    public function index(Request $request)
    {
        $title = 'Load Point';

        // Ambil input search, default ke '' biar aman
        $search = $request->input('search', '');

        // Pecah jadi multi keyword, kalau kosong = array kosong
        $keywords = preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);

        // Query data: hanya hari ini + multi keyword + order + paginate
        $excas = Exca::whereDate('created_at', now()->toDateString())
            ->when($keywords, function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->where(function ($q) use ($word) {
                        $q->where('loading_unit', 'ILIKE', "%{$word}%")
                          ->orWhere('easting', 'ILIKE', "%{$word}%")
                          ->orWhere('northing', 'ILIKE', "%{$word}%")
                          ->orWhere('elevation_rl', 'ILIKE', "%{$word}%")
                          ->orWhere('elevation_actual', 'ILIKE', "%{$word}%")
                          ->orWhere('front_width', 'ILIKE', "%{$word}%")
                          ->orWhere('front_height', 'ILIKE', "%{$word}%");
                    });
                }
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        // Jika AJAX: return partial table
        if ($request->ajax()) {
            return view('admin.operasional.exca.partials.table_body', compact('excas'))->render();
        }

        // Jika normal: return full page
        return view('admin.operasional.exca.excavator', compact('title', 'excas'));
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // dd($request->all()); 
        $request->validate([
            'loading_unit' => 'required',
            'easting' => 'required|numeric',
            'northing' => 'required|numeric',
            'elevation_rl' => 'required|numeric',
            'elevation_actual' => 'required|numeric',
            'front_width' => 'required|numeric',
            'front_height' => 'required|numeric',
        ]);        

        Exca::create([
            'loading_unit' => $request->loading_unit,
            'easting' => str_replace(',', '.', $request->easting),
            'northing' => str_replace(',', '.', $request->northing),
            'elevation_rl' => $request->elevation_rl,
            'elevation_actual' => $request->elevation_actual,
            'front_width' => $request-> front_width,
            'front_height' => $request-> front_height,
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
            'loading_unit' => 'required',
            'easting' => 'required|numeric',
            'northing' => 'required|numeric',
            'elevation_rl' => 'required|numeric',
            'elevation_actual' => 'required|numeric',
            'front_width' => 'required|numeric',
            'front_height' => 'required|numeric',
        ]);


        // Validate input update
        $easting = str_replace(',', '.', $request->easting);
        $northing = str_replace(',', '.', $request->northing);


        // Update data
        $exca->update([
            'loading_unit' => $request->loading_unit,
            'easting' => $easting,
            'northing' => $northing,
            'elevation_rl' => $request->elevation_rl,
            'elevation_actual' => $request->elevation_actual,
            'front_width' => $request-> front_width,
            'front_height' => $request-> front_height,
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
