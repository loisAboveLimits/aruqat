<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AboutPage extends Model implements HasMedia
{
    use SoftDeletes, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'content',
        'vision_title',
        'vision_content',
        'clients_title',
        'clients_content',
        'goals_title',
        'goals_content',
        'is_active',
    ];

    public $translatable = [
        'hero_title',
        'content',
        'vision_title',
        'vision_content',
        'clients_title',
        'clients_content',
        'goals_title',
        'goals_content',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
