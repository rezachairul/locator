<?php

namespace App\Notifications;

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
        return [
            'title' => 'Laporan Insiden Baru',
            'body' => $this->report->incident_type . ' korban ' . $this->report->victim_name,
            'url' => route('admin.laporan-user.incident-user.index'),
        ];
    }
}
