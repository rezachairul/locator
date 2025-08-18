<?php

namespace App\Notifications;

use App\Models\IncidentUser;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

/**
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $data
 * @property \Carbon\Carbon|null $read_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class UserReportNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    protected $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
            'title' => '⛏️🚨 Laporan Insiden Tambang',
            'body'  => '🪨 Insiden *' . $this->report->incident_type . '* melibatkan ' . $this->report->victim_name . 
                    ' di area operasi tambang. Kategori cedera: ' . $this->report->injury_category . '.',
            'injury_category' => $this->report->injury_category,
            'url'    => $url,
        ];
    }

    public function toBroadcast($notifiable)
    {
        $incident = IncidentUser::where('user_report_id', $this->report->id)->first();
        $url = $incident
            ? route('admin.laporan-user.incident-user.show', $incident->id)
            : route('admin.laporan-user.incident-user.index');

        return new BroadcastMessage([
            'title' => '⛏️🚨 Laporan Insiden Tambang',
            'body'  => '🪨 Insiden *' . $this->report->incident_type . '* melibatkan ' . $this->report->victim_name . 
                    ' di area operasi tambang. Kategori cedera: ' . $this->report->injury_category . '.',
            'injury_category' => $this->report->injury_category,
            'url' => $url,
        ]);
    }
}
