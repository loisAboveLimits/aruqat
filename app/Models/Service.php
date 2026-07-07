<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use SoftDeletes, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'sort_order',
        'is_active',
    ];

    public $translatable = [
        'title',
        'description',
    ];

    protected $appends = [
        'icon_url',
    ];

    public function getIconUrlAttribute()
    {
        return $this->getFirstMediaUrl('service_icons');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('service_icons')
            ->singleFile();
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
