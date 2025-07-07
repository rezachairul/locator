<?php

namespace App\Http\Controllers\admin\operator;

use App\Models\User;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'User';
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');

        // Pisah multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $adminQuery = User::where('role', 'admin');
        $operatorQuery = User::where('role', 'operator')
            ->where(function ($query) {
                $query->whereDate('created_at', today())
                    ->orWhere('email', 'operator.operator@locatorgis.test');
            });

        // Apply search jika ada
        if ($search) {
            $adminQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($qq) use ($word) {
                        $qq->where('name', 'ILIKE', "%{$word}%")
                        ->orWhere('username', 'ILIKE', "%{$word}%")
                        ->orWhere('email', 'ILIKE', "%{$word}%");
                    });
                }
            });

            $operatorQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($qq) use ($word) {
                        $qq->where('name', 'ILIKE', "%{$word}%")
                        ->orWhere('username', 'ILIKE', "%{$word}%")
                        ->orWhere('email', 'ILIKE', "%{$word}%");
                    });
                }
            });
        }

        // Ambil data sesuai filter
        if ($filter == 'admin') {
            $admins = $adminQuery->get();
            $operators = collect(); // kosong
        } elseif ($filter == 'operator') {
            $admins = collect(); // kosong
            $operators = $operatorQuery->get();
        } else { // all
            $admins = $adminQuery->get();
            $operators = $operatorQuery->get();
        }

        // Merge + Pagination Manual
        $merged = $admins->concat($operators);
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $users = new LengthAwarePaginator($currentItems, $merged->count(), $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        // Count card tetap dari semua data
        $adminCount = User::where('role', 'admin')->count();
        $operatorCount = User::where('role', 'operator')
            ->where(function ($query) {
                $query->whereDate('created_at', today())
                    ->orWhere('email', 'operator.operator@locatorgis.test');
            })->count();

        // AJAX response
        if ($request->ajax()) {
            return view('admin.operator.partials.table_body', compact('title', 'admins', 'users', 'operators', 'adminCount', 'operatorCount'))->render();
        }

        // View utama
        return view('admin.operator.operator', compact('title', 'admins', 'users', 'operators', 'adminCount', 'operatorCount'));
    }


    public function export(Request $request)
    {
        $role = $request->query('filter'); // ambil dari query string
        return (new UserExport($role))->export();
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
        return redirect()->route('admin.operator.index')->with('success', 'Data User berhasil ditambahkan');
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
            return redirect()->route('admin.operator.index')->with('error', 'Data tidak ditemukan.');
        }
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
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
        return redirect()->route('admin.operator.index')->with('success', 'Data User berhasil diperbarui.');
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
            return redirect()->route('admin.operator.index')->with('error', 'Data tidak ditemukan.');
        }
        // Hapus data operator
        $operator->delete();
        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.operator.index')->with('success', 'Data User berhasil dihapus.');

    }
}
