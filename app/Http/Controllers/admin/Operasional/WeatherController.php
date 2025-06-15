<?php

namespace App\Http\Controllers\admin\Operasional;

use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Weather';

        // Ambil input search (boleh kosong)
        $search = $request->input('search', '');

        // Pisahkan search jadi array kata
        $keywords = preg_split('/\s+/', $search);

        // Query Weather hanya untuk hari ini + search + order + paginate
        $weathers = Weather::whereDate('created_at', now()->toDateString())
            ->when($search, function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->where('cuaca', 'ILIKE', "%{$word}%")
                          ->orWhere('curah_hujan', 'ILIKE', "%{$word}%");
                }
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        // Ambil 1 data paling baru
        $latestWeather = Weather::latest()->first();

        // Mapping Labels
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

        // Fetch data dari API BMKG
        $bmkgWeather = [];
        try {
            $kodeWilayah = '64.03.03.2005';
            $url = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4={$kodeWilayah}";
            $response = Http::get($url);

            if ($response->successful()) {
                $bmkgWeather = $response->json();
            }

            Log::info('BMKG Response:', $bmkgWeather);
        } catch (\Exception $e) {
            $bmkgWeather = ['error' => 'Gagal mengambil data dari BMKG: ' . $e->getMessage()];
            Log::error('BMKG API Error:', ['message' => $e->getMessage()]);
        }

        // Jika request AJAX, return partial table saja
        if ($request->ajax()) {
            return view('admin.operasional.weather.partials.table_body', compact('title', 'weathers', 'latestWeather', 'bmkgWeather', 'cuacaLabels'))->render();
        }

        // Normal render
        return view('admin.operasional.weather.weather', compact(
            'title', 'weathers', 'latestWeather', 'bmkgWeather', 'cuacaLabels'));
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
