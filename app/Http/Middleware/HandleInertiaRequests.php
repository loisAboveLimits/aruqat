<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $settings = \App\Models\SiteSetting::first();
        
        return array_merge(parent::share($request), [
            'settings' => $settings ? [
                'id' => $settings->id,
                'site_name' => $settings->getTranslations('site_name'),
                'address' => $settings->getTranslations('address'),
                'email' => $settings->email,
                'phone' => $settings->phone,
                'social' => [
                    'facebook' => $settings->facebook_url,
                    'x' => $settings->x_url,
                    'linkedin' => $settings->linkedin_url,
                    'instagram' => $settings->instagram_url,
                ],
                'footer' => [
                    'description' => $settings->getTranslations('footer_description'),
                    'nav' => $settings->getTranslations('footer_nav'),
                    'copyright' => $settings->getTranslations('copyright_text'),
                    'tqnia_copyright' => $settings->getTranslations('tqnia_copyright_text'),
                ],
                'logo_url' => $settings->getFirstMediaUrl('logo'),
                'footer_logo_url' => $settings->getFirstMediaUrl('footer_logo'),
                'favicon_url' => $settings->getFirstMediaUrl('favicon'),
                'copyright_image_url' => $settings->getFirstMediaUrl('copyright_image'),
                'about_hero_url' => $settings->getFirstMediaUrl('about_hero'),
                'services_hero_url' => $settings->getFirstMediaUrl('services_hero'),
                'contact_hero_url' => $settings->getFirstMediaUrl('contact_hero'),
                'blog_hero_url' => $settings->getFirstMediaUrl('blog_hero'),
            ] : null,
            'auth' => [
                'user' => $request->user(),
            ],
        ]);
    }
}
