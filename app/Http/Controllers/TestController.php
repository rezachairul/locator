<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Test';
        $tests = Test::all();
        return view('test.test', compact('title', 'tests'));
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
        // Validasi input
        $request->validate([
            'name' => 'required',
            // 'image' => 'required|mimetypes:image/png,image/jpg,image/jpeg|max:51200',
        ]);

        // Proses upload file gambar
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName); // simpan gambar di folder public/images
            
        //     // Simpan data ke database
        //     Test::create([
        //         'name' => $request->name,
        //         'image' => $imageName, // Simpan nama file gambar
        //     ]);
        // }
        Test::create([
            'name' => $request->name,
            // 'image' => $imageName, // Simpan nama file gambar
        ]);

        return redirect()->route('test.index')->with('success', 'Test created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        dd($id);
        $test = Test::findOrFail($id);
        $test->delete();
        return redirect()->route('test.index')->with('success', 'Test deleted successfully');
    }
}
