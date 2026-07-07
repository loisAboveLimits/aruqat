<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HomePage::updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'ar' => 'شركة أروقة النظام للمحاماة والاستشارات القانونية',
                    'en' => 'Arwqat Al Netham Law Firm & Legal Consultancy',
                ],
                'hero_subtitle' => [
                    'ar' => 'نقدم حلولاً قانونية مبتكرة وشاملة',
                    'en' => 'We provide innovative and comprehensive legal solutions',
                ],
                'hero_cta_label' => [
                    'ar' => 'خدماتنا',
                    'en' => 'Our Services',
                ],
                'hero_cta_url' => '/services',
                'hero_secondary_cta_label' => [
                    'ar' => 'اتصل بنا',
                    'en' => 'Contact Us',
                ],
                'hero_secondary_cta_url' => '/contact',
                
                'about_badge' => [
                    'ar' => 'عن أروقة النظام',
                    'en' => 'About Arwqat Al Netham',
                ],
                'about_title' => [
                    'ar' => 'نحن شركة رائدة في المحاماة',
                    'en' => 'We are a leading Law Firm',
                ],
                'about_description' => [
                    'ar' => '<p>شركة أروقة النظام للمحاماة والاستشارات القانونية تعد من أكثر شركات المحاماة تميزاً في المملكة العربية السعودية.</p>',
                    'en' => '<p>Arwqat Al Netham Law Firm and Legal Consultancy is one of the most distinguished law firms in the Kingdom of Saudi Arabia.</p>',
                ],
                'about_cta_label' => [
                    'ar' => 'قراءة المزيد',
                    'en' => 'Read More',
                ],
                'about_cta_url' => '/about-us',

                'goal_badge' => [
                    'ar' => 'هدفنا',
                    'en' => 'Our Goal',
                ],
                'goal_title' => [
                    'ar' => 'نركز على الجودة والالتزام',
                    'en' => 'We focus on quality and commitment',
                ],
                'goal_description' => [
                    'ar' => '<p>نحن نؤمن بأن التميز القانوني يبدأ من فهم عميق لاحتياجات العملاء وبناء علاقات مبنية على الثقة والمصداقية.</p>',
                    'en' => '<p>We believe that legal excellence begins with a deep understanding of client needs and building relationships based on trust and credibility.</p>',
                ],
                'goal_cta_label' => [
                    'ar' => 'قراءة المزيد',
                    'en' => 'Read More',
                ],
                'goal_cta_url' => '/about-us',
                'is_active' => true,
            ]
        );
    }
}
