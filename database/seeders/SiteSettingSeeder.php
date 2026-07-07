<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => ['ar' => 'أروقة النظام', 'en' => 'Aruqat Alnizam'],
                'address' => ['ar' => 'الرياض، المملكة العربية السعودية', 'en' => 'Riyadh, Saudi Arabia'],
                'email' => 'info@aruqat.com',
                'phone' => '+966500000000',
                'facebook_url' => 'https://facebook.com',
                'x_url' => 'https://x.com',
                'linkedin_url' => 'https://linkedin.com',
                'instagram_url' => 'https://instagram.com',
                'footer_description' => ['ar' => 'وصف تذييل الصفحة هنا', 'en' => 'Footer description here'],
                'copyright_text' => ['ar' => 'جميع الحقوق محفوظة © 2026 أروقة النظام', 'en' => 'All Rights Reserved © 2026 Aruqat Alnizam'],
                'footer_nav' => [
                    'ar' => [
                        ['label' => 'الرئيسية', 'url' => '/'],
                        ['label' => 'من نحن', 'url' => '/about-us'],
                        ['label' => 'خدماتنا', 'url' => '/services'],
                    ],
                    'en' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'About Us', 'url' => '/about-us'],
                        ['label' => 'Services', 'url' => '/services'],
                    ],
                ],
            ]
        );
    }
}
