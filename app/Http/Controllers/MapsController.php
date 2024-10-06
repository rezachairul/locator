<?php

namespace App\Http\Controllers;

use App\Models\Maps;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Maps';
        $maps = Maps::all();

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
        
        // dd($request->all());
        // Validasi input
        // $request->validate([
        //     'fileName' => 'required',
        //     'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png,gif,bmp,ecw|file|max:51200', 
        // ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        // Hapus file dari penyimpanan
        // dd($id);
        $maps = Maps::find($id);
        $maps->delete();
        return redirect()->route('maps.index')->with('success', 'File deleted successfully!');
    }
}
