<?php

namespace App\Http\Controllers\Operasional;

use App\Models\Operasional;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class OperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Operasional';
        $operasionals = Operasional::orderBy('id', 'asc')->paginate(10);
        return view('operasional/operasional/operasional', compact('title', 'operasionals'));
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
