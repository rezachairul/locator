<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $loading_unit
 * @property float $easting
 * @property float $northing
 * @property float $elevation_rl
 * @property float $elevation_actual
 * @property float $front_width
 * @property float $front_height
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class Exca extends Model
{
    use HasFactory;
    protected $table = 'excas';

    protected $guarded = ['id'];

    public function dashboards()
    {
        return $this->hasMany(Dashboard::class);
    }
    public function lapangans()
    {
        return $this->hasMany(Lapangan::class);
    }
}
