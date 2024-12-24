<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $dashboards = Dashboard::with(['exca', 'dumping', 'waterdepth', 'weather'])->get();
        return view('/dashboard', compact( 'title', 'dashboards'));
    }

}
