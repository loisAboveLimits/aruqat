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


        return Inertia::render('BlogDetail', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
