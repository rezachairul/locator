<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maps extends Model
{
    use HasFactory;
    protected $table = 'maps';
    
    protected $fillable = [
        'name',
        'type',
        'filename',
        'path',
        'size',
    ];

    public function lapangans()
    {
        return $this->hasMany(Lapangan::class);
    }
}
