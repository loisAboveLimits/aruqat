<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\SeoSetting;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class BlogController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();

        $translations = json_decode(
            File::get(base_path("src/i18n/{$locale}.json")),
            true
        );

        $posts = BlogPost::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(12)
            ->through(function ($post) {
                $post->cover_url = $post->getFirstMediaUrl('blog_covers');
                return $post;
            });

        //$seo = SeoSetting::where('page', 'blog')->first();

        $seo = $translations['articles']['seo'];

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

        //dd($seoTools);

        return Inertia::render('BlogPage', [
            'posts' => $posts,
            'seo' => $seoTools,
        ]);
    }

    public function show($id)
    {
        // Try to find by slug first, then ID
        $post = BlogPost::where('slug', $id)->orWhere('id', $id)->firstOrFail();

        $locale = app()->getLocale();
        
        if ($post->status !== 'published' && !auth()->check()) {
            abort(404);
        }

        $post->cover_url = $post->getFirstMediaUrl('blog_covers');
        $post->author_name = $post->author?->name;

        $relatedPosts = BlogPost::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get()
            ->map(function ($p) {
                $p->cover_url = $p->getFirstMediaUrl('blog_covers');
                return $p;
            });

            $seoTools = [

                'id' => $post->id,
                'seo_title' => $post->getTranslation('seo_title', $locale,false),
                'seo_description' => $post->getTranslation('seo_description', $locale,false),
                'seo_keywords' => $post->getTranslation('seo_keywords', $locale,false),
                'canonical_url' => $post->getTranslation('canonical_url', $locale,false),
                'og_title' => $post->getTranslation('og_title', $locale,false),
                'og_description' => $post->getTranslation('og_description', $locale,false),
                'og_image' => $post->getFirstMediaUrl('og_image') ?: null,                
                'twitter_title' => $post->getTranslation('twitter_title', $locale,false),
                'twitter_description' => $post->getTranslation('twitter_description',$locale,false),
                'twitter_image' => $post->getFirstMediaUrl('twitter_image') ?: null, 
                'robots' => $post->getTranslation('robots', $locale,false),

            ];


        return Inertia::render('BlogDetail', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'seo' => $seoTools,
        ]);
    }
}
