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

    public function fetch()
    {
        $notifications = Auth::user()
            ->unreadNotifications
            ->take(10)
            ->map(function ($notif) {
                return [
                    'id' => $notif->id,
                    'title' => $notif->data['title'] ?? 'Notifikasi',
                    'body' => $notif->data['body'] ?? $notif->data['message'] ?? '',
                    'url' => $notif->data['url'] ?? '#',
                    'status' => $notif->data['status'] ?? null,
                    'injury_category' => $notif->data['injury_category'] ?? null,
                    'time' => $notif->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'count' => $notifications->count(),
            'data' => $notifications
        ]);
    }
}

