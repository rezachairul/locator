<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $victim_name
 * @property int|null $victim_age
 * @property string $injury_category
 * @property string $activity
 * @property string $incident_type
 * @property \Carbon\Carbon $incident_date_time
 * @property string $incident_location
 * @property string $asset_damage
 * @property string $environmental_impact
 * @property string $incident_description
 * @property string $report_by
 * @property \Carbon\Carbon $report_date_time
 * @property int|null $user_id
 * @property string $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class UserReport extends Model
{
    /** @use HasFactory<\Database\Factories\UserReportFactory> */
    use HasFactory;
    protected $guarded = ['id', 'status'];
    public function incident_user()
    {
        return $this->hasMany(IncidentUser::class);
    }
    // Event: Membuat entri incident_user saat user_report baru dibuat
    protected static function booted()
    {
        static::created(function ($userReport) {
            // Menambahkan entri ke tabel incident_users
            IncidentUser::create([
                'user_report_id' => $userReport->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }

    // Relasi ke tabel user_report_photos
    public function photos()
    {
        return $this->hasMany(UserReportPhoto::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}