<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandImage extends Model
{
    protected $fillable = [
        'brand_id',
        'image_path',
        'title_tr',
        'title_en',
        'description_tr',
        'description_en',
        'is_active',
        'order',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
