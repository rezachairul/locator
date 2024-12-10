<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dumping extends Model
{
    use HasFactory;

    protected $table = 'dumpings';

    protected $fillable = [
        'disposial',
        'easting',
        'northing',
        'elevation_rl',
        'elevation_actual',
    ];

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

    // Relasi: Dumping memiliki banyak Excas
    // public function excas(): HasMany
    // {
    //     return $this->hasMany(Exca::class, 'dumping_id');
    // }
}
