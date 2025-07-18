<?php

namespace App\Http\Controllers\admin\Operasional;

use App\Models\Exca;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ExcaController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Load Point';

        // Ambil input search, default ke '' biar aman
        $search = $request->input('search', '');

        // Pecah jadi multi keyword, kalau kosong = array kosong
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

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
            return view('admin.operasional.exca.partials.table_body', compact('excas', 'title'))->render();
        }

        // Jika normal: return full page
        return view('admin.operasional.exca.excavator', compact('title', 'excas'));
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

        return redirect()->route('admin.operasional.exca.index')->with('success', 'Berhasil Tambah Data Excavator');
    }

    public function update(Request $request, $id)
    {
        $exca = Exca::find($id);

        // Cek jika data ditemukan
        if (!$exca) {
            return redirect()->route('admin.operasional.exca.index')->with('error', 'Data Excavator tidak ditemukan');
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

        return redirect()->route('admin.operasional.exca.index')->with('success', 'Data Excavator berhasil diperbarui');
    }

    public function destroy($id)
    {
        // dd($id);
        $exca = Exca::findOrFail($id);
        $exca->delete();
        return redirect()->route('admin.operasional.exca.index')->with('success', 'Item deleted successfully.');
    }
}
