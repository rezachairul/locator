<?php

namespace App\Http\Controllers;


use App\Models\Maps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Maps';
        $maps = Maps::all();

        // Filter data untuk hanya yang berumur 24 jam terakhir
        // $maps = Maps::where('created_at', '>=', now()->subDay())
        // ->orderBy('id', 'asc')
        // ->get();
        
        // Filter data untuk reset pukul 00.00
        $maps = Maps::whereDate('created_at', now()->toDateString())
        ->orderBy('id', 'asc')
        ->get();

        return view('maps/maps',compact('title', 'maps'));
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
        
        // ddd($request->all());

        $request->validate([
            'fileName' => 'required',
            'file' => 'required|mimetypes:application/octet-stream|max:51200', // tambahkan MIME type ECW
        ]);  
         
        // Mendapatkan nama asli file
        $originalName = $request->file('file')->getClientOriginalName();
        
        // Simpan file ke folder yang diinginkan
        $path = $request->file('file')->storeAs('uploads', $originalName, 'public'); // menyimpan file dengan nama asli

        // Simpan data ke database
        Maps::create([
            'fileName' => $request->fileName,
            'file' => $path, // menyimpan path file yang disimpan
        ]);

        return redirect()->route('maps.index')->with('success', 'File uploaded successfully!');
    }   



    /**
     * Display the specified resource.
     */
    public function show(Maps $maps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maps $maps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        // Cari data berdasarkan ID
        $maps = Maps::find($id);

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$maps) {
            return redirect()->route('maps.index')->with('error', 'Data tidak ditemukan.');
        }

        // Validasi input
        $request->validate([
            'fileName' => 'required|string|max:255', // Pastikan nama file tidak kosong
            'file' => 'nullable|mimetypes:application/octet-stream|max:51200', // File opsional
        ]);

        // Update nama file
        $maps->fileName = $request->fileName;

        // Cek apakah ada file baru yang diunggah
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($maps->file && Storage::exists($maps->file)) {
                Storage::delete($maps->file);
            }

            // Simpan file baru
            $originalName = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('uploads', $originalName, 'public');
            $maps->file = $path;
        }

        // Simpan perubahan
        $maps->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('maps.index')->with('success', 'Data berhasil diperbarui.');
    }
    // public function destroy($id)
    // {
        
    //     $maps = Maps::findOrFail($id);
    //     $maps->delete();
    //     return redirect()->route('maps.index');
    // }
    public function destroy($id)
    {
        // dd($id);
        // Cari data berdasarkan ID
        $maps = Maps::findOrFail($id);

        // Periksa apakah file ada di penyimpanan lokal
        if ($maps->file && Storage::exists($maps->file)) {
            // Hapus file dari penyimpanan lokal
            Storage::delete($maps->file);
        }

        // Hapus data dari database
        $maps->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('maps.index')->with('success', 'Data dan file berhasil dihapus.');
    }

}
