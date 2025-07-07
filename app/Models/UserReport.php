<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
