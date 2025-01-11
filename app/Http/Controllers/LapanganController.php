<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Exca;
use App\Models\Dumping;
use App\Models\Weather;
use App\Models\Waterdepth;
use App\Http\Requests\StoreLapanganRequest;
use App\Http\Requests\UpdateLapanganRequest;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Operator Lapangan';

        // Filter data berdasarkan tanggal hari ini
        $today = now()->startOfDay();
        $totalExca = Exca::where('created_at', '>=', $today)->count();
        $totalDumping = Dumping::where('created_at', '>=', $today)->count();
        $latestWeather = Weather::where('created_at', '>=', $today)->latest()->first();
        $latestWaterDepth = Waterdepth::where('created_at', '>=', $today)->latest()->first();


        return view('lapangan/lapangan', compact('title', 'totalExca', 'totalDumping', 'latestWeather', 'latestWaterDepth'));
    }
}
