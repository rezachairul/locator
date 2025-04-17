<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
