<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentUser extends Model
{
    /** @use HasFactory<\Database\Factories\IncidentUserFactory> */
    use HasFactory;
    protected $fillable = ['user_report_id'];

    public function user_report()
    {
        return $this->belongsTo(UserReport::class);
    }
}
