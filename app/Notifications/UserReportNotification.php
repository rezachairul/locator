<?php

namespace App\Notifications;

use App\Models\IncidentUser;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class UserReportNotification extends Notification
{
    use Queueable;

    protected $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    // Cari incident_user berdasarkan user_report_id
    $incident = IncidentUser::where('user_report_id', $this->report->id)->first();

    // Jika tidak ditemukan, fallback ke halaman index
    $url = $incident
        ? route('admin.laporan-user.incident-user.show', $incident->id)
        : route('admin.laporan-user.incident-user.index');

   return [
        'title' => '⚠️ Laporan Insiden Tambang',
        'body' => '📍 ' . $this->report->incident_type . ' menimpa ' . $this->report->victim_name . ' di area kerja.',
        'url' => $url,
    ];
}
}
