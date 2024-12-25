<?php

namespace App\Http\Controllers;

use App\Models\Exca;
use App\Models\Dumping;
use App\Models\Weather;
use App\Models\Dashboard;
use App\Models\Waterdepth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $title = 'Dashboard';
    //     $dashboards = Dashboard::with(['exca', 'dumping', 'waterdepth', 'weather'])->get();
    //     return view('/dashboard', compact( 'title', 'dashboards'));
        
    // }
    public function index()
    {
        $title = 'Dashboard';
        $dashboard = Dashboard::all();
        $totalExca = Exca::count(); // Total Excavator
        $totalDumping = Dumping::count(); // Total Dumping Point
        $latestWeather = Weather::latest()->first(); // Data cuaca terbaru
        $latestWaterDepth = Waterdepth::latest()->first(); // Data water depth terbaru

        return view('dashboard', compact('title', 'totalExca', 'totalDumping', 'latestWeather', 'latestWaterDepth'));
    }

}
