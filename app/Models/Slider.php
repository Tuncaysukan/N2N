<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title_tr',
        'title_en',
        'subtitle_tr',
        'subtitle_en',
        'image_path',
        'button_text_tr',
        'button_text_en',
        'button_link',
        'is_active',
        'order',
    ];
}
