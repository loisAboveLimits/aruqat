<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\SeoSetting;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $seo = SeoSetting::where('page', 'contact')->first();

        return Inertia::render('ContactPage', [
            'services' => $services,
            'seo' => $seo,
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
