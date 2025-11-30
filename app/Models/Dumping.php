<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $disposial
 * @property float $easting
 * @property float $northing
 * @property float $elevation_rl
 * @property float $elevation_actual
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class Dumping extends Model
{
    use HasFactory;

    protected $table = 'dumpings';
    protected $guarded = ['id'];

    public function exca(): HasMany
    {
        return $this->hasMany(Exca::class);
    }
    public function dashboards()
    {
        return $this->hasMany(Dashboard::class);
    }
    public function lapangans()
    {
        return $this->hasMany(Lapangan::class);
    }
}