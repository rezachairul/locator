<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Models\Exca;
use App\Models\Dumping;
use App\Models\Weather;
use App\Models\Waterdepth;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        $title = 'Dashboard';

        // Filter data berdasarkan tanggal hari ini
        $today = now()->startOfDay();
        $totalExca = Exca::where('created_at', '>=', $today)->count();
        $totalDumping = Dumping::where('created_at', '>=', $today)->count();
        $latestWeather = Weather::where('created_at', '>=', $today)->latest()->first();
        $latestWaterDepth = Waterdepth::where('created_at', '>=', $today)->latest()->first();

        return view('admin.dashboard', compact('title', 'totalExca', 'totalDumping', 'latestWeather', 'latestWaterDepth'));
    }
}
