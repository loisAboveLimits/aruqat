<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

class BlogController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();

        $posts = BlogPost::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(12)
            ->through(function ($post) {
                $post->cover_url = $post->getFirstMediaUrl('blog_covers');
                return $post;
            });

        $seo = SeoSetting::where('page', 'blog')->first();

        $seoTools = [

            'seo_title' => "asdasd",
            'seo_description' => "sadasdasd",
            'seo_keywords' => "",
            'canonical_url' => "",
            'og_title' => "",
            'og_description' => "",
            'og_image' => "",                
            'twitter_title' => "",
            'twitter_description' => "",
            'twitter_image' => "", 
            'robots' => "",

        ];        


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
