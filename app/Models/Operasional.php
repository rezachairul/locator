<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $pit
 * @property int $loading_unit_id     // relasi ke tabel excas
 * @property string $dop              // Date of Processing? (silakan sesuaikan maknanya)
 * @property int $dumping_id          // relasi ke tabel dumpings
 * @property int $material_id         // relasi ke tabel materials
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @property \App\Models\Exca $loadingUnit
 * @property \App\Models\Dumping $dumping
 * @property \App\Models\Material $material
 */

class Operasional extends Model
{
    /** @use HasFactory<\Database\Factories\OperasionalFactory> */
    use HasFactory;
    protected $table = 'operasionals';
    protected $guarded = ['id'];

    // Operasional items
    public function exca(): BelongsTo
    {
        return $this->belongsTo(Exca::class , 'loading_unit_id');
    }
    public function dumping(): BelongsTo
    {
        return $this->belongsTo(Dumping::class , 'dumping_id');
    }
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class , 'material_id');
    }
    public function weather(): BelongsTo
    {
        return $this->belongsTo(Weather::class , 'weather_id');
    }
    public function waterdepth(): BelongsTo
    {
        return $this->belongsTo(Waterdepth::class , 'waterdepth_id');
    }
}

