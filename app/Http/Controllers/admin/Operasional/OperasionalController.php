<?php

namespace App\Http\Controllers\admin\Operasional;

use App\Models\Exca;
use App\Models\Dumping;
use App\Models\Weather;
use App\Models\Material;
use App\Models\Waterdepth;
use App\Models\Operasional;
use Illuminate\Http\Request;
use App\Exports\OperasionalExport;
// use App\Services\OperasionalExport;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;

class OperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Operasional';

        // Ambil search keyword, aman kalau null
        $search = $request->input('search', '');

        // Pisahkan Multi Keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];


        // Query Operasional: multi-keyword & relasi
        $operasionals = Operasional::when($keywords, function ($query) use ($keywords) {
            foreach ($keywords as $word) {
                $query->where(function ($q) use ($word) {
                    $q->where('pit', 'ILIKE', "%{$word}%")
                        ->orWhere('dop', 'ILIKE', "%{$word}%")
                        ->orWhereHas('exca', function ($q2) use ($word) {
                            $q2->where('loading_unit', 'ILIKE', "%{$word}%");
                        })
                        ->orWhereHas('dumping', function ($q2) use ($word) {
                            $q2->where('disposial', 'ILIKE', "%{$word}%");
                        })
                        ->orWhereHas('material', function ($q2) use ($word) {
                            $q2->where('name', 'ILIKE', "%{$word}%");
                        });
                });
            }
        })
        ->orderBy('id', 'asc')
        ->paginate(10);

        // Ambil Exca hanya untuk hari ini
        $excas = Exca::whereDate('created_at', now()->toDateString())->get();
        if ($excas->isEmpty()) {
            $excas = collect([(object) ['id' => '', 'loading_unit' => 'No Loading Unit available']]);
        }

        // Ambil Dumping hanya untuk hari ini
        $dumpings = Dumping::whereDate('created_at', now()->toDateString())->get();
        if ($dumpings->isEmpty()) {
            $dumpings = collect([(object) ['id' => '', 'disposial' => 'No Disposial available']]);
        }

        // Ambil Material hanya untuk hari ini, fallback ke semua, fallback dummy
        $materials = Material::whereDate('created_at', now()->toDateString())->get();
        if ($materials->isEmpty()) {
            $materials = Material::all();
        }
        if ($materials->isEmpty()) {
            $materials = collect([(object) ['id' => '', 'name' => 'No Materials available']]);
        }

        // Ambil Weather & Waterdepth terbaru hari ini
        $today = now()->startOfDay();
        $latestWeather = Weather::where('created_at', '>=', $today)->latest()->first();
        $latestWaterDepth = Waterdepth::where('created_at', '>=', $today)->latest()->first();

        // Jika request AJAX (pencarian)
        if ($request->ajax()) {
            return view('admin.operasional.operasional.partials.table_body', compact('title', 'operasionals', 'excas', 'dumpings', 'materials', 'latestWeather', 'latestWaterDepth'))->render();
        }

        // View full
        return view('admin.operasional.operasional.operasional', compact(
            'title', 'operasionals', 'excas', 'dumpings', 'materials', 'latestWeather', 'latestWaterDepth'));
    }

     /**
     * Export data to Excel.
     */    
    public function export(OperasionalExport $exportService)
    {
        // dd('Exporting data...');
        return $exportService->export();
        // $date = date('dmY');
        // return Excel::download(new OperasionalExport(), "Operasional_{$date}.xlsx");
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
        return redirect()->route('admin.operasional.operasional.index')->with('success', 'Data berhasil disimpan');
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
        return redirect()->route('admin.operasional.operasional.index')->with('success', 'Berhasil Update Data Operasional');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $operasional = Operasional::findOrFail($id);
        $operasional->delete();
        return redirect()->route('admin.operasional.operasional.index')->with('success', 'Item deleted successfully.');

    }
}
