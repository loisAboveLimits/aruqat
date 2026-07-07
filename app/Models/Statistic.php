<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Statistic extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'value',
        'sort_order',
        'is_active',
    ];

    public $translatable = [
        'title',
    ];
}
