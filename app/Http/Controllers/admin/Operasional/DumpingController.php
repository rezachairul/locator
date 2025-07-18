<?php

namespace App\Http\Controllers\admin\Operasional;

use App\Models\Dumping;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DumpingController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Waste Dump';
        $search = $request->input('search', '');

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Filter hanya data hari ini + multi keyword + order + paginate
        $dumpings = Dumping::whereDate('created_at', now()->toDateString())
            ->when($search, function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->where(function ($q) use ($word) {
                        $q->where('disposial', 'ILIKE', "%{$word}%")
                            ->orWhere('easting', 'ILIKE', "%{$word}%")
                            ->orWhere('northing', 'ILIKE', "%{$word}%")
                            ->orWhere('elevation_rl', 'ILIKE', "%{$word}%")
                            ->orWhere('elevation_actual', 'ILIKE', "%{$word}%");
                    });
                }
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        // Jika AJAX: balikin partial table
        if ($request->ajax()) {
            return view('admin.operasional.dumping.partials.table_body', compact('dumpings', 'title'))->render();
        }

        // Jika normal: full page
        return view('admin.operasional.dumping.dumping', compact('title', 'dumpings'));
    }

    public function store(Request $request)
    {        
        //  dd($request->all());
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
        
        return redirect()->route('admin.operasional.dumping.index')->with('succes', 'Data added successfully.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Mencari model berdasarkan ID
        $dumping = Dumping::find($id);

        // Cek jika data ditemukan
        if (!$dumping) {
            return redirect()->route('admin.operasional.dumping.index')->with('error', 'Data updated successfully.');
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

        return redirect()->route('admin.operasional.dumping.index')->with('error', 'Update data successfully.');
    }

    public function destroy($id)
    {
        // dd($id);
        $dumping = Dumping::findOrFail($id);
        $dumping->delete();
        return redirect()->route('admin.operasional.dumping.index')->with('success', 'Item deleted successfully.');
    }
}
