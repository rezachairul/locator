<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name        // nama file user-friendly
 * @property string $type        // ecw / mbtiles
 * @property string $filename    // nama file asli di storage
 * @property string $path        // path file di storage
 * @property int|null $size      // ukuran file (dalam byte)
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

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
