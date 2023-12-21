<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stok extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'stokadi',
        'birim',
        'miktar',
        'fiyat',
    ];
}
