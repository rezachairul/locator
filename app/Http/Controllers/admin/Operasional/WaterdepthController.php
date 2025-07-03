<?php

namespace App\Http\Controllers\admin\Operasional;

use App\Models\WaterDepth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WaterdepthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Water Depth';

        // Ambil input search
        $search = $request->input('search', '');

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query hanya data hari ini + filter search + order + paginate
        $waterdepths = WaterDepth::whereDate('created_at', now()->toDateString())
            ->when($search, function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->where('shift', 'ILIKE', "%{$word}%")
                          ->orWhere('qsv_1', 'ILIKE', "%{$word}%")
                          ->orWhere('h4', 'ILIKE', "%{$word}%");
                }
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        // Jika AJAX: return partial table saja
        if ($request->ajax()) {
            return view('admin.operasional.waterdepth.partials.table_body', compact('title','waterdepths'))->render();
        }

        // Jika normal: return full page
        return view('admin.operasional.waterdepth.waterdepth', compact('title', 'waterdepths'));
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
        return redirect()->route('admin.operasional.waterdepth.index')->with('success', 'Data added successfully.');
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
            return redirect()->route('admin.operasional.waterdepth.index')->with('error', 'Data not found');
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

        return redirect()->route('admin.operasional.waterdepth.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    { 
        // dd($id);
        $waterdepth = WaterDepth::findOrFail($id);
        $waterdepth->delete();
        return redirect()->route('admin.operasional.waterdepth.index')->with('Success', 'Data Delete successfully.');
    }
}
