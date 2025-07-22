<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $shift
 * @property float $qsv_1
 * @property float $h4
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class Waterdepth extends Model
{
    use HasFactory;
    
    protected $table = 'waterdepths';
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

