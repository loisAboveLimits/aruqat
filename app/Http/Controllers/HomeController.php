<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use App\Models\Statistic;
use App\Models\ClientLogo;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\BlogPost;
use App\Models\SeoSetting;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;


class HomeController extends Controller
{
    use SEOToolsTrait;

    public function index()
    {
        $homePage = HomePage::where('is_active', true)->latest()->first();
        
        $hero = null;
        $about = null;
        $goal = null;

        if ($homePage) {
            $hero = [
                'id' => $homePage->id,
                'title' => $homePage->getTranslations('hero_title'),
                'cta_label' => $homePage->getTranslations('hero_cta_label'),
                'cta_url' => $homePage->hero_cta_url,
                'secondary_cta_label' => $homePage->getTranslations('hero_secondary_cta_label'),
                'secondary_cta_url' => $homePage->hero_secondary_cta_url,
                'background_image_url' => $homePage->getFirstMediaUrl('hero_background') ?: null,
            ];

            $about = [
                'id' => $homePage->id,
                'badge' => $homePage->getTranslations('about_badge'),
                'description' => $homePage->getTranslations('about_description'),
                'cta_label' => $homePage->getTranslations('about_cta_label'),
                'cta_url' => $homePage->about_cta_url,
                'office_image_url' => $homePage->getFirstMediaUrl('about_office') ?: null,
            ];

            $goal = [
                'id' => $homePage->id,
                'badge' => $homePage->getTranslations('goal_badge'),
                'title' => $homePage->getTranslations('goal_title'),
                'cta_label' => $homePage->getTranslations('goal_cta_label'),
                'cta_url' => $homePage->goal_cta_url,
                'background_image_url' => $homePage->getFirstMediaUrl('goal_background') ?: null,
            ];
        }

        $stats = Statistic::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function($stat) {
                return [
                    'id' => $stat->id,
                    'title' => $stat->getTranslations('title'),
                    'value' => $stat->value,
                ];
            });
        $clientLogos = ClientLogo::all()->map(function($logo) {
            $logo->image_url = $logo->getFirstMediaUrl('client_logos');
            return $logo;
        });

        $services = Service::where('is_active', true)->orderBy('sort_order')->get()->map(function($service) {
            return [
                'id' => $service->id,
                'title' => $service->getTranslations('title'),
                'description' => $service->getTranslations('description'),
                'icon_url' => $service->icon_url,
            ];
        });
        
        $team = TeamMember::where('is_active', true)->orderBy('sort_order')->get()->map(function($member) {
            return [
                'id' => $member->id,
                'name' => $member->getTranslations('name'),
                'position' => $member->getTranslations('position'),
                'photo_url' => $member->getFirstMediaUrl('team_photos'),
            ];
        });

        $articles = BlogPost::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($post) {
                $post->cover_url = $post->getFirstMediaUrl('blog_covers');
                return $post;
            });

        $seo = SeoSetting::where('page', 'home')->first();
    
        /*SEO*/
        SEOMeta::setTitle('Home');
        SEOMeta::setDescription('This is my page description');
        SEOMeta::setKeywords('asdasd,rtrtyrty,dfgdfg');
        SEOMeta::setCanonical('https://codecasts.com.br/lesson');

        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Home');
        OpenGraph::setUrl('http://current.url.com');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle('Homepage');
        TwitterCard::setSite('@LuizVinicius73asdad');

        // JsonLd::setTitle('Homepage');
        // JsonLd::setDescription('This is my page descriptionasdasd');
        // JsonLd::addImage('https://codecasts.com.br/img/logo.jpg');  

        return Inertia::render('Index', [
            'hero' => $hero,
            'about' => $about,
            'goal' => $goal,
            'stats' => $stats,
            'clientLogos' => $clientLogos,
            'services' => $services,
            'team' => $team,
            'articles' => $articles,
            'seo' => $seo,
        ]);
    }

}
