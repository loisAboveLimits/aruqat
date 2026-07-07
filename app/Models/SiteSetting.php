<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'site_name',
        'address',
        'email',
        'phone',
        'facebook_url',
        'x_url',
        'linkedin_url',
        'instagram_url',
        'footer_description',
        'footer_nav',
        'copyright_text',
        'tqnia_copyright_text',
    ];

    public $translatable = [
        'site_name',
        'address',
        'footer_description',
        'copyright_text',
        'tqnia_copyright_text',
        'footer_nav',
    ];

    protected $casts = [
        // Spatie translatable handles JSON
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('favicon')->singleFile();
        $this->addMediaCollection('logo')->singleFile();
        $this->addMediaCollection('footer_logo')->singleFile();
        $this->addMediaCollection('copyright_image')->singleFile();
        $this->addMediaCollection('about_hero')->singleFile();
        $this->addMediaCollection('services_hero')->singleFile();
        $this->addMediaCollection('contact_hero')->singleFile();
        $this->addMediaCollection('blog_hero')->singleFile();
    }
}
