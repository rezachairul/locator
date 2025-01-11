<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    /** @use HasFactory<\Database\Factories\LapanganFactory> */
    use HasFactory;
    protected $fillable = ['exca_id', 'dumping_id', 'waterdepth_id', 'weather_id'];
    public function maps()
    {
        return $this->belongsTo(Maps::class);
    }
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
}
