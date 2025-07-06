<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    public function destroy($id)
    {
        
        // Mengambil notifikasi berdasarkan ID dari pengguna yang sedang login
        $notification = Auth::user()->notifications->firstWhere('id', $id);

        if ($notification) {
            $notification->delete();
            return back()->with('success', 'Notifikasi berhasil dihapus.');
        }

        return back()->with('error', 'Notifikasi tidak ditemukan.');
    }

}

