<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $exca_id
 * @property int $dumping_id
 * @property int $waterdepth_id
 * @property int $weather_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class Dashboard extends Model
{
    use HasFactory;
    protected $fillable = ['exca_id', 'dumping_id', 'waterdepth_id', 'weather_id'];

    public function exca()
    {
        return $this->belongsTo(Exca::class);
    }
    public function dumping()
    {
        return $this->belongsTo(Dumping::class);
    }
    public function waterdepth()
    {
        return $this->belongsTo(WaterDepth::class);
    }
    public function weather()
    {
        return $this->belongsTo(Weather::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
