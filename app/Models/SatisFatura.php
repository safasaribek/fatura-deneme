<?php

namespace App\Models;

use App\Http\Controllers\CariController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'iskonto',
        'faturatarihi',
        'sontarih',
        'odemeyontemi',
        'parabirimi',
        'kur',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('stokadi')
            ->saveSlugsTo('slug');
    }

    public function cari()
    {
        return $this->belongsToMany(Cari::class, FaturaCari::class,'satis_faturas_id','caris_id');
    }
}
