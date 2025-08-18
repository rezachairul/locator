<?php

namespace App\Http\Controllers\Lapangan;

use App\Models\Maps;
use App\Models\Exca;
use App\Models\Dumping;
use App\Models\Weather;
use App\Models\Waterdepth;
use Illuminate\Routing\Controller;

class LapanganController extends Controller
{

    public function index()
    {
        $title = 'Operator Lapangan';

        // Filter data berdasarkan tanggal hari ini
        $today = now()->startOfDay();
        $totalExca = Exca::where('created_at', '>=', $today)->count();
        $totalDumping = Dumping::where('created_at', '>=', $today)->count();
        $latestWeather = Weather::where('created_at', '>=', $today)->latest()->first();
        $latestWaterDepth = Waterdepth::where('created_at', '>=', $today)->latest()->first();
        // Ambil maps pertama untuk ditampilkan
        $maps = Maps::where('type', 'mbtiles')->orderBy('id', 'desc')->get();
        $firstMapId = $maps->first()->id ?? null;

        return view('lapangan.lapangan', compact('title', 'totalExca', 'totalDumping', 'latestWeather', 'latestWaterDepth', 'firstMapId'));
    }
}
