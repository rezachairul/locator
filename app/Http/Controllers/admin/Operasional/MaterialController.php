<?php

namespace App\Http\Controllers\admin\Operasional;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MaterialController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Materials';
        $search = $request->input('search', '');
        
        // Ambil data sesuai kondisi pencarian atau tidak
        $materials = Material::when($search, function ($query) use ($search) {
            // Pisah kata kunci: spasi, tab, enter
            $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

            foreach ($keywords as $word) {
                // Untuk PostgreSQL: ILIKE = case-insensitive LIKE
                $query->where('name', 'ILIKE', '%' . $word . '%');
            }
        })
        ->orderBy('id', 'asc')
        ->paginate(10);

        // Cek apakah ini request AJAX (pencarian)
        if ($request->ajax()) {
            return view('admin.operasional.material.partials.table_body', compact('title', 'materials'))->render();
        }

        return view('admin.operasional.material.material', compact('title', 'materials'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
        ]);
        Material::create($request->all());
        return redirect()->route('admin.operasional.material.index')->with('success', 'File uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        // Cari data berdasarkan ID
        $materials = Material::find($id);

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$materials) {
            return redirect()->route('admin.operasional.material.index')->with('error', 'Data tidak ditemukan!');
        }
        // Validasi input
        $request->validate([
            'name' => 'required',
        ]);
        // Update data
        $materials->update($request->all());
        // Redirect ke halaman index
        return redirect()->route('admin.operasional.material.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        // dd($id);
        // Cari data berdasarkan ID
        $materials = Material::find($id);
        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$materials) {
        return redirect()->route('admin.operasional.material.index')->with('error', 'Data tidak ditemukan!');
        }
        // Hapus data
        $materials->delete();
        // Redirect ke halaman index
        return redirect()->route('admin.operasional.material.index')->with('success', 'Data berhasil dihapus!');
    }
}
