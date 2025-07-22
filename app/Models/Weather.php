<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $cuaca // Nilai enum: cerah, cerah_berawan, berawan, berawan_tebal, hujan_ringan, hujan_sedang, hujan_lebat, hujan_petir, kabut
 * @property float $curah_hujan
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class Weather extends Model
{
    use HasFactory;
    protected $table = 'weathers';
    protected $guarded = ['id'];

    public function getCuacaLabelAttribute()
    {
        $cuacaLabels = [
            'cerah' => 'Cerah',
            'cerah_berawan' => 'Cerah Berawan',
            'berawan' => 'Berawan',
            'berawan_tebal' => 'Berawan Tebal',
            'hujan_ringan' => 'Hujan Ringan',
            'hujan_sedang' => 'Hujan Sedang',
            'hujan_lebat' => 'Hujan Lebat',
            'hujan_petir' => 'Hujan Petir',
            'kabut' => 'Kabut'
        ];
        return $cuacaLabels[$this->cuaca] ?? $this->cuaca;
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
