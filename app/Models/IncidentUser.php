<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_report_id
 * @property string $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class IncidentUser extends Model
{
    /** @use HasFactory<\Database\Factories\IncidentUserFactory> */
    use HasFactory;
    protected $fillable = ['user_report_id', 'status'];

    public function user_report()
    {
        return $this->belongsTo(UserReport::class);
    }
}
