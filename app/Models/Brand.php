<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BrandImage;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description_tr',
        'description_en',
        'image',
        'is_active',
        'order',
    ];

    public function images()
    {
        return $this->hasMany(BrandImage::class)->orderBy('order');
    }

    public function activeImages()
    {
        return $this->hasMany(BrandImage::class)->where('is_active', true)->orderBy('order');
    }
}
