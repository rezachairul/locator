<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waterdepth extends Model
{
    use HasFactory;
    
    protected $table = 'waterdepths';
    protected $fillable = [
        'shift',
        'qsv_1',
        'h4',
    ];
}

