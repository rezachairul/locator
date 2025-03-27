<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operasional extends Model
{
    /** @use HasFactory<\Database\Factories\OperasionalFactory> */
    use HasFactory;
    protected $table = 'operasionals';
    protected $guarded = ['id'];

    // Operasional items
    public function exca(): BelongsTo
    {
        return $this->belongsTo(Exca::class , 'exca_id');
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

