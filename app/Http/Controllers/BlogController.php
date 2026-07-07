<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\SeoSetting;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(12)
            ->through(function ($post) {
                $post->cover_url = $post->getFirstMediaUrl('blog_covers');
                return $post;
            });

        $seo = SeoSetting::where('page', 'blog')->first();

        return Inertia::render('BlogPage', [
            'posts' => $posts,
            'seo' => $seo,
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
