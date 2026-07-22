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
use Illuminate\Support\Facades\App;
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

        $locale = app()->getLocale();

        //dd(app()->getLocale());

        if ($homePage) {
            $hero = [
                'id' => $homePage->id,
                'title' => $homePage->getTranslation('hero_title', $locale,false),
                'cta_label' => $homePage->getTranslation('hero_cta_label', $locale,false),
                'cta_url' => $homePage->hero_cta_url,
                'secondary_cta_label' => $homePage->getTranslation('hero_secondary_cta_label', $locale,false),
                'secondary_cta_url' => $homePage->hero_secondary_cta_url,
                'background_image_url' => $homePage->getFirstMediaUrl('hero_background') ?: null,
            ];

            $about = [
                'id' => $homePage->id,
                'badge' => $homePage->getTranslation('about_badge', $locale,false),
                'description' => $homePage->getTranslation('about_description', $locale,false),
                'cta_label' => $homePage->getTranslation('about_cta_label', $locale,false),
                'cta_url' => $homePage->about_cta_url,
                'office_image_url' => $homePage->getFirstMediaUrl('about_office') ?: null,
            ];

            $goal = [
                'id' => $homePage->id,
                'badge' => $homePage->getTranslation('goal_badge', $locale,false),
                'title' => $homePage->getTranslation('goal_title', $locale,false),
                'cta_label' => $homePage->getTranslation('goal_cta_label', $locale,false),
                'cta_url' => $homePage->goal_cta_url,
                'background_image_url' => $homePage->getFirstMediaUrl('goal_background') ?: null,
            ];

            $seoTools = [

                'id' => $homePage->id,
                'seo_title' => $homePage->getTranslation('seo_title', $locale,false),
                'seo_description' => $homePage->getTranslation('seo_description', $locale,false),
                'seo_keywords' => $homePage->getTranslation('seo_keywords', $locale,false),
                'canonical_url' => $homePage->getTranslation('canonical_url', $locale,false),
                'og_title' => $homePage->getTranslation('og_title', $locale,false),
                'og_description' => $homePage->getTranslation('og_description', $locale,false),
                'og_image' => $homePage->getFirstMediaUrl('og_image') ?: null,                
                'twitter_title' => $homePage->getTranslation('twitter_title', $locale,false),
                'twitter_description' => $homePage->getTranslation('twitter_description',$locale,false),
                'twitter_image' => $homePage->getFirstMediaUrl('twitter_image') ?: null, 
                'robots' => $homePage->getTranslation('robots', $locale,false),

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
        // SEOMeta::setTitle($seoTools['seo_title']);
        // SEOMeta::setDescription($seoTools['seo_description']);
        // SEOMeta::setKeywords($seoTools['seo_keywords']);
        // SEOMeta::setCanonical($seoTools['canonical_url']);

        // OpenGraph::setTitle($seoTools['og_title']);
        // OpenGraph::setDescription($seoTools['og_description']);
        // OpenGraph::addImage($seoTools['og_image']);

        // TwitterCard::setTitle($seoTools['twitter_title']);
        // TwitterCard::setSite($seoTools['twitter_description']);
        // TwitterCard::addImage($seoTools['twitter_image']);

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
            'seo' => $seoTools,
        ]);
    }

}
