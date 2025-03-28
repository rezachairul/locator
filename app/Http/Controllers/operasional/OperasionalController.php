<?php

namespace App\Http\Controllers\Operasional;

use App\Models\Exca;
use App\Models\Dumping;
use App\Models\Material;
use App\Models\Operasional;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Operasional';
        $operasionals = Operasional::orderBy('id', 'asc')->paginate(10);

        // Ambil data Exca
        $excas = Exca::all();
        // Filter excas berdasarkan tanggal hari ini
        $excas = Exca::whereDate('created_at', now()->toDateString())->get();
        if ($excas->isEmpty()) {
            $excas = collect([
                (object) ['id' => '', 'loading_unit' => 'No Loading Unit available']
            ]);
        }

        // Ambil data Waste Dump
        $dumpings = Dumping::all();
        // Filter dumpings berdasarkan tanggal hari ini
        $dumpings = Dumping::whereDate('created_at', now()->toDateString())->get();
        if ($dumpings->isEmpty()) {
            $dumpings = collect([
                (object) ['id' => '', 'disposial' => 'No Disposial available']
            ]);
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

        return view('operasional/operasional/operasional', compact('title', 'operasionals', 'excas', 'dumpings', 'materials'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operasional $operasional)
    {
        //
    }
}
