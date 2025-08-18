<?php
// app/Notifications/UserReportStatusUpdated.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;



/**
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $data
 * @property string $status
 * @property \App\Models\UserReport $report
 * @property \Carbon\Carbon|null $read_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class UserReportStatusUpdated extends Notification implements ShouldBroadcast
{
    use Queueable;

    public string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // kita pakai database, bukan email
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => '⛏️ Status laporan insiden tambang Anda telah diperbarui menjadi "' 
                        . ucfirst(str_replace('_', ' ', $this->status)) . '".',
            'status' => $this->status,
            'url' => route('operator.user-report.index'),
        ];
    }
    
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => '⛏️ Status laporan insiden tambang Anda telah diperbarui menjadi "' 
                        . ucfirst(str_replace('_', ' ', $this->status)) . '".',
            'status' => $this->status,
            'url' => route('operator.user-report.index'),
        ]);
    }
}
