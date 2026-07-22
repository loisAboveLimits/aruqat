<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SeoSetting;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function index()
    {

        $locale = app()->getLocale();

        $translations = json_decode(
            File::get(base_path("src/i18n/{$locale}.json")),
            true
        );
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $seo = $translations['services']['seo'];

        $seoTools = [

            'seo_title' => $seo['seo_title'],
            'seo_description' => $seo['seo_description'],
            'seo_keywords' => $seo['seo_keywords'],
            'canonical_url' => $seo['canonical_url'],
            'og_title' => $seo['og_title'],
            'og_description' => $seo['og_description'],
            'og_image' => $seo['og_image'],                
            'twitter_title' => $seo['twitter_title'],
            'twitter_description' => $seo['twitter_description'],
            'twitter_image' => $seo['twitter_image'], 
            'robots' => $seo['robots'],

        ];


        return Inertia::render('ServicesPage', [
            'services' => $services->map(function($service) {
                return [
                    'id' => $service->id,
                    'title' => $service->getTranslations('title'),
                    'description' => $service->getTranslations('description'),
                    'icon_url' => $service->icon_url,
                ];
            }),
            'seo' => $seoTools,
        ]);
    }
}
