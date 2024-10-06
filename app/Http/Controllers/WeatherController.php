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


        return view('weather/weather', compact('title', 'weathers'));
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
        return redirect()->route('weather.index')->with('Success', 'Berhasil Tambah Data Cuaca');
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
    public function update(Request $request, Weather $weather)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Weather $weather)
    {   
        
        $weather->delete();
        return redirect()->route('weather.index')->with('Success', 'Item deleted successfully');
    }
}
