<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
