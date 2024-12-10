<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Weather';
        $weathers = Weather::all();
        
        // Ambil data cuaca terbaru
        $latestWeather = Weather::latest()->first();

        //Mapping Labels
        $cuacaLabels = [
            'cerah' => 'Cerah',
            'cerah_berawan' => 'Cerah Berawan',
            'berawan' => 'Berawan',
            'berawan_tebal' => 'Berawan Tebal',
            'hujan_ringan' => 'Hujan Ringan',
            'hujan_sedang' => 'Hujan Sedang',
            'hujan_lebat' => 'Hujan Lebat',
            'hujan_petir' => 'Hujan Petir',
            'kabut' => 'Kabut'
        ];
        foreach($weathers as $weather){
            $weather->cuaca_label = $cuacaLabels[$weather->cuaca] ?? $weather->cuaca;
        }

        //Menambahkan pengurutan berdasarkan 'id' secara ascending
        $weathers = Weather::orderBy('id', 'asc')->get();

        return view('weather/weather', compact('title', 'weathers',  'latestWeather'));
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
        $request->validate([
            'cuaca' => 'required|in:cerah,cerah_berawan,berawan,berawan_tebal,hujan_ringan,hujan_sedang,hujan_lebat,hujan_petir,kabut',
            'curah_hujan' => 'required|numeric',
        ]);

        Weather::create([
            'cuaca' => $request->cuaca,
            'curah_hujan' => $request->curah_hujan,
        ]);
        return redirect()->route('weather.index')->with('Success', 'Data added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Weather $weather)
    {
        //
    }  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Weather $weather)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        // Mencari model berdasarkan ID
        $weather = Weather::find($id);

        // Cek jika data tidak ditemukan
        if(!$weather){
            return redirect()->route('weather.index')->with('error', 'Data not found');
        }

        // Validasi input
        $request->validate([
            'cuaca' => 'required|in:cerah,cerah_berawan,berawan,berawan_tebal,hujan_ringan,hujan_sedang,hujan_lebat,hujan_petir,kabut',
            'curah_hujan' => 'required|numeric',
        ]);

        // Update data
        $weather->update([
            'cuaca' => $request->cuaca,
            'curah_hujan' => $request->curah_hujan,
        ]);

        return redirect()->route('weather.index')->with('Success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
        // dd($id);
        $weather = Weather::findOrFail($id);
        $weather->delete();
        return redirect()->route('weather.index')->with('Success', 'Item deleted successfully');
    }
}
