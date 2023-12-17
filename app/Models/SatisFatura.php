<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SatisFatura extends Model
{
    use HasFactory,HasSlug,SoftDeletes;

    protected $fillable = [
        'stokadi',
        'slug',
        'miktar',
        'fiyat',
        'kdv',
        'iskonto'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('stokadi')
            ->saveSlugsTo('slug');
    }
}
