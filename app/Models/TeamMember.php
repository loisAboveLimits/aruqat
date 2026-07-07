<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TeamMember extends Model implements HasMedia
{
    use SoftDeletes, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'name',
        'position',
        'bio',
        'sort_order',
        'is_active',
    ];

    public $translatable = [
        'name',
        'position',
        'bio',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
