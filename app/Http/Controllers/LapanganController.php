<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index()
    {
        return view('lapangan/lapangan',[
            'title' => 'Operasional Lapangan',

        ]);
    }
}
