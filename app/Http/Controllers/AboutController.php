<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePage;
use App\Models\Statistic;
use App\Models\TeamMember;
use App\Models\SeoSetting;
use Inertia\Inertia;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class AboutController extends Controller
{
    public function index()
    {
        $aboutPage = \App\Models\AboutPage::where('is_active', true)->latest()->first();

        $locale = app()->getLocale();
        //dd(app()->getLocale());
        
        $about = null;
        if ($aboutPage) {
            $about = [
                'id' => $aboutPage->id,
                'hero_title' => $aboutPage->getTranslation('hero_title', $locale, false),
                'content' => $aboutPage->getTranslation('content', $locale, false),
                'vision_title' => $aboutPage->getTranslation('vision_title', $locale, false),
                'vision_content' => $aboutPage->getTranslation('vision_content', $locale, false),
                'clients_title' => $aboutPage->getTranslation('clients_title', $locale, false),
                'clients_content' => $aboutPage->getTranslation('clients_content', $locale, false),
                'goals_title' => $aboutPage->getTranslation('goals_title', $locale, false),
                'goals_content' => $aboutPage->getTranslation('goals_content', $locale, false),
                'office_image_url' => $aboutPage->getFirstMediaUrl('about_office') ?: null,
            ];

            $seoTools = [

                'id' => $aboutPage->id,
                'seo_title' => $aboutPage->getTranslation('seo_title', $locale, false),
                'seo_description' => $aboutPage->getTranslation('seo_description', $locale,false),
                'seo_keywords' => $aboutPage->getTranslation('seo_keywords', $locale,false),
                'canonical_url' => $aboutPage->getTranslation('canonical_url', $locale,false),
                'og_title' => $aboutPage->getTranslation('og_title', $locale,false),
                'og_description' => $aboutPage->getTranslation('og_description', $locale,false),
                'og_image' => $aboutPage->getFirstMediaUrl('og_image') ?: null,                
                'twitter_title' => $aboutPage->getTranslation('twitter_title', $locale,false),
                'twitter_description' => $aboutPage->getTranslation('twitter_description',$locale,false),
                'twitter_image' => $aboutPage->getFirstMediaUrl('twitter_image') ?: null, 
                'robots' => $aboutPage->getTranslation('robots', $locale,false),

            ];
        }

        //dd($seoTools);

        $stats = \App\Models\Statistic::where('is_active', true)->orderBy('sort_order')->get()->map(function($stat) {
            return [
                'id' => $stat->id,
                'title' => $stat->getTranslations('title'),
                'value' => $stat->value,
            ];
        });
        
        $team = TeamMember::where('is_active', true)->orderBy('sort_order')->get()->map(function($member) {
            return [
                'id' => $member->id,
                'name' => $member->getTranslation('name', $locale, false),
                'position' => $member->getTranslation('position', $locale, false),
                'photo_url' => $member->getFirstMediaUrl('team_photos'),
            ];
        });

        $seo = SeoSetting::where('page', 'about')->first();

        
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

        return Inertia::render('AboutUs', [
            'about' => $about,
            'stats' => $stats,
            'team' => $team,
            'seo' => $seoTools,
        ]);
    }
}
