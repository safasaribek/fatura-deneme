<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Cari extends Model
{
    use HasFactory,SoftDeletes,HasSlug;

    protected $fillable = [
        'adi',
        'soyadi',
        'email',
        'slug',
        'kimlikno',
        'vergino',
        'telefon',
        'adres',
        'ulke',
        'il',
        'ilce',
        'caritipi',
        'bakiye',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('adi')
            ->saveSlugsTo('slug');
    }

}
