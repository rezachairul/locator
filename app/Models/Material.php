<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function exca(): HasMany
    {
        return $this->hasMany(Exca::class);
    }
    // public function dumping(): HasMany
    // {
    //     return $this->hasMany(Dumping::class);
    // }
}
