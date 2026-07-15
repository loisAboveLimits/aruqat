<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SeoSetting;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $seo = SeoSetting::where('page', 'services')->first();

        SEOMeta::setTitle('Services');
        SEOMeta::setDescription('This is my page description');
        SEOMeta::setKeywords('asdasd,rtrtyrty,dfgdfg');
        SEOMeta::setCanonical('https://codecasts.com.br/lesson');

        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Home');
        OpenGraph::setUrl('http://current.url.com');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle('Homepage');
        TwitterCard::setSite('@LuizVinicius73asdad');

        return Inertia::render('ServicesPage', [
            'services' => $services->map(function($service) {
                return [
                    'id' => $service->id,
                    'title' => $service->getTranslations('title'),
                    'description' => $service->getTranslations('description'),
                    'icon_url' => $service->icon_url,
                ];
            }),
            'seo' => $seo,
        ]);
    }
}
