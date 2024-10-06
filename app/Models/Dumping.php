<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dumping extends Model
{
    use HasFactory;
    protected $table = 'dumpings';
    protected $fillable = [
        'disposial',
        'easting',
        'northing',
        'elevation',
    ];
    protected $appends = ['disposial'];

    public function getDisposialAttribute()
    {
        $disLabels = [
            'ipdsidewallutara' => 'IPD Sidewall Utara',
            'ss3' => 'SS3',
        ];

        return $disLabels[$this->attributes['disposial']] ?? $this->attributes['disposial'];
    }
}
