<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exca extends Model
{
    use HasFactory;
    protected $table = 'excas';


    protected $guarded = ['id'];
    

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

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
    public function dumping(): BelongsTo
    {
        return $this->belongsTo(Dumping::class);
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
