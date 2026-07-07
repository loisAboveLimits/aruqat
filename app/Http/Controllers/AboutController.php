<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePage;
use App\Models\Statistic;
use App\Models\TeamMember;
use App\Models\SeoSetting;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        $aboutPage = \App\Models\AboutPage::where('is_active', true)->latest()->first();
        
        $about = null;
        if ($aboutPage) {
            $about = [
                'id' => $aboutPage->id,
                'hero_title' => $aboutPage->getTranslations('hero_title'),
                'content' => $aboutPage->getTranslations('content'),
                'vision_title' => $aboutPage->getTranslations('vision_title'),
                'vision_content' => $aboutPage->getTranslations('vision_content'),
                'clients_title' => $aboutPage->getTranslations('clients_title'),
                'clients_content' => $aboutPage->getTranslations('clients_content'),
                'goals_title' => $aboutPage->getTranslations('goals_title'),
                'goals_content' => $aboutPage->getTranslations('goals_content'),
                'office_image_url' => $aboutPage->getFirstMediaUrl('about_office') ?: null,
            ];
        }

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
                'name' => $member->getTranslations('name'),
                'position' => $member->getTranslations('position'),
                'photo_url' => $member->getFirstMediaUrl('team_photos'),
            ];
        });

        $seo = SeoSetting::where('page', 'about')->first();

        return Inertia::render('AboutUs', [
            'about' => $about,
            'stats' => $stats,
            'team' => $team,
            'seo' => $seo,
        ]);
    }
}
