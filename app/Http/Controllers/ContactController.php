<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\SeoSetting;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();

        $translations = json_decode(
            File::get(base_path("src/i18n/{$locale}.json")),
            true
        );        
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
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

        return Inertia::render('ContactPage', [
            'services' => $services,
            'seo' => $seoTools,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable',
        ]);

        ContactMessage::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'subject' => $validated['service'] ?? 'General Inquiry',
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Message sent successfully!');
    }
}
