<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaturaCari extends Model
{
    use HasFactory;

    protected $fillable = [
        'satis_faturas_id',
        'caris_id'
    ];
}
