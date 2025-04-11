<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'User';
        // Ambil admin (default/fixed)
        $admins = User::where('role', 'admin')->get();

        // Ambil operator yang diinput hari ini
        $operators = User::where('role', 'operator')
            ->whereDate('created_at', today())
            ->get();
        
        // Merge admins dan operators
         // Gabungkan admin + operator
        $merged = $admins->concat($operators);

        // Custom pagination
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $users = new LengthAwarePaginator($currentItems, $merged->count(), $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        $adminCount = $admins->count();
        $operatorCount = $operators->count();

        return view('operator/operator', compact('title', 'admins', 'users', 'operators', 'adminCount', 'operatorCount'));
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
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'role' => 'required|string|in:admin,operator',
            'password' => 'required|string|min:8',
        ]);

        // Ambil nama depan dari input name
        $firstName = strtolower(strtok($request->name, " ")); // hanya ambil kata pertama (nama depan)
        $role = $request->role;

        // Buat email secara otomatis
        $email = "{$firstName}.{$role}@locatorgis.test";

        // Validasi agar email juga unik
        if (User::where('email', $email)->exists()) {
            return back()->withErrors(['email' => 'Email otomatis sudah digunakan. Silakan ubah nama atau role.'])->withInput();
        }

        // Simpan ke DB Users
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman operator
        return redirect()->route('operator.index')->with('success', 'Data User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd(request()->all());
        // Cari data berdasarkan ID
        $user = User::findOrFail($id);
        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$user) {
            return redirect()->route('operator.index')->with('error', 'Data tidak ditemukan.');
        }
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'role' => 'required|string|in:admin,operator',
            'password' => 'nullable|string|min:8',
        ]);
        // Ambil nama depan & generate ulang email
        $firstName = strtolower(strtok($request->name, " "));
        $role = $request->role;
        $email = "{$firstName}.{$role}@locatorgis.test";

        // Cek jika email sudah dipakai oleh user lain
        if (User::where('email', $email)->where('id', '!=', $user->id)->exists()) {
            return back()->withErrors(['email' => 'Email otomatis sudah digunakan. Ubah nama atau role.'])->withInput();
        }

        // Update data
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role = $request->role;

        // Optional: Auto-generate email (kalau kamu gak ambil dari input)
        $firstName = strtolower(strtok($request->name, ' '));
        $user->email = $firstName . '.' . $request->role . '@locatorgis.test';

        // Password hanya diubah kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('operator.index')->with('success', 'Data User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        // Cari data berdasarkan ID
        $operator = User::findOrFail($id);
        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$operator) {
            return redirect()->route('operator.index')->with('error', 'Data tidak ditemukan.');
        }
        // Hapus data operator
        $operator->delete();
        // Redirect kembali dengan pesan sukses
        return redirect()->route('operator.index')->with('success', 'Data User berhasil dihapus.');

    }
}
