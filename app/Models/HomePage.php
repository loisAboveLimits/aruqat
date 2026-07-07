<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HomePage extends Model implements HasMedia
{
    use SoftDeletes, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'hero_cta_label',
        'hero_cta_url',
        'hero_secondary_cta_label',
        'hero_secondary_cta_url',
        'about_badge',
        'about_description',
        'about_cta_label',
        'about_cta_url',
        'goal_badge',
        'goal_title',
        'goal_cta_label',
        'goal_cta_url',
        'is_active',
    ];

    public $translatable = [
        'hero_title',
        'hero_cta_label',
        'hero_secondary_cta_label',
        'about_badge',
        'about_description',
        'about_cta_label',
        'goal_badge',
        'goal_title',
        'goal_cta_label',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
