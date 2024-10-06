<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exca extends Model
{
    use HasFactory;
    protected $table = 'excas';

     protected $fillable = [
        'pit',
        'loading_unit',
        'easting',
        'northing',
        'elevation',
        'material',
        'dop',
    ];

    public function dumpings()
    {
        return $this->hasMany(Dumping::class, 'exca_id');
    }

    public function getPitLabelAttribute()
    {
        $pitLabels = [
            'qsv1s' => 'QSV1S',
            'qsv3' => 'QSV3'
        ];

        return $pitLabels[$this->pit] ?? $this->pit;
    }

    public function getLoadingUnitLabelAttribute()
    {
        $loadingUnitLabels = [
            'fex400_441' => 'FEX400-441',
            'fex400_419' => 'FEX400-419',
            'fex400_449' => 'FEX400-449',
            'fex400_454' => 'FEX400-454',
            'fex400_456' => 'FEX400-456'
        ];

        return $loadingUnitLabels[$this->loading_unit] ?? $this->loading_unit;
    }

    public function getMaterialLabelAttribute()
    {
        $materialLabels = [
            's' => 'S',
            'm' => 'M',
            'c' => 'C',
            'b' => 'B',
            'nb' => 'NB',
            'otr' => 'OTR'
        ];

        return $materialLabels[$this->material] ?? $this->material;
    }
}
