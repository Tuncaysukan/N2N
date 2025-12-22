<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'title_tr',
        'title_en',
        'content_tr',
        'content_en',
        'meta_title_tr',
        'meta_title_en',
        'meta_description_tr',
        'meta_description_en',
        'meta_keywords_tr',
        'meta_keywords_en',
        'is_active',
    ];
}
