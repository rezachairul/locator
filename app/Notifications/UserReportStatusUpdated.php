<?php
// app/Notifications/UserReportStatusUpdated.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserReportStatusUpdated extends Notification
{
    use Queueable;

    public string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database']; // kita pakai database, bukan email
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Status laporan Anda telah diperbarui menjadi "' . ucfirst(str_replace('_', ' ', $this->status)) . '".',
            'status' => $this->status,
            'url' => route('operator.user-report.index'),
        ];
    }
}
