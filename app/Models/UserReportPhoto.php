<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_report_id
 * @property string $photo_path
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class UserReportPhoto extends Model
{
    /** @use HasFactory<\Database\Factories\UserReportPhotoFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function userReport()
    {
        return $this->belongsTo(UserReport::class);
    }
}