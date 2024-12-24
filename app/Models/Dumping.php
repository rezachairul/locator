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

    // protected $fillable = [
    //     'disposial',
    //     'easting',
    //     'northing',
    //     'elevation_rl',
    //     'elevation_actual',
    // ];
    protected $guarded = ['id'];

    // Menambahkan atribut virtual disposial_label
    protected $appends = ['disposial_label'];

    // Accessor untuk disposial_label
    public function getDisposialLabelAttribute()
    {
        $disLabels = [
            'ipdsidewallutara' => 'IPD Sidewall Utara',
            'ss3' => 'SS3',
        ];

        return $disLabels[$this->attributes['disposial']] ?? $this->attributes['disposial'];
    }

    public function dashboards()
    {
        return $this->hasMany(Dashboard::class);
    }

    // public function material(): BelongsTo
    // {
    //     return $this->belongsTo(Material::class);
    // }
    // public function exca(): HasMany
    // {
    //     return $this->hasMany(Exca::class);
    // }
}
