<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AboutPage::updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'ar' => 'مـن نحـــن',
                    'en' => 'About Us',
                ],
                'content' => [
                    'ar' => '<p>شركة أروقة النظام للمحاماة والاستشارات القانونية تعد من أكبر شركات المحاماة حضراً في المملكة العربية السعودية، وتضم نخبة من الكوادر المؤهلة والمجربة في كافة مجالات المحاماة والقانون، مما يجعل الشركة القانونية الأولى والأكثر تميزاً.</p><p>ونحن نسعى لتقديم خدمات قانونية عالمية متميزة في كل مجال من مجالاتنا، حيث نعمل على بناء علاقة طويلة مع عملائنا قائمة على الثقة المتبادلة.</p><p>كما أننا نسعى لتقديم خدمات قانونية متخصصة وشاملة من خلال نخبة من المحامين والمستشارين القانونيين ذوي الخبرة والكفاءة العالية. نعمل على تقديم حلول مبتكرة وفعّالة لتلبية احتياجات عملائنا في القطاعات المختلفة، سواء كانوا أفراداً أو شركات.</p>',
                    'en' => '<p>Arwqat Al Netham Law Firm and Legal Consultancy is one of the largest and most prominent law firms in the Kingdom of Saudi Arabia, comprising an elite group of qualified and experienced professionals in all areas of law and legal practice.</p><p>We strive to provide distinguished global legal services in every area of our expertise, building long-term relationships with our clients based on mutual trust.</p><p>We also strive to provide specialized and comprehensive legal services through an elite team of lawyers and legal consultants with high experience and competence. We work to provide innovative and effective solutions to meet the needs of our clients across various sectors, whether individuals or companies.</p>',
                ],
                'vision_title' => [
                    'ar' => 'رؤيتنا',
                    'en' => 'Our Vision',
                ],
                'vision_content' => [
                    'ar' => 'نسعى لبناء علاقة طيبة تقوم مع عملائنا على الثقة المتبادلة وذلك عبر تقديم أجود الخدمات القانونية، وذلك من خلال تطوير وتحسين مستوى الأعمال والخدمات التي تقدم لتلبية جميع المتطلبات القانونية إلى أبعد حد وتحقيقها.',
                    'en' => 'We seek to build a good relationship with our clients based on mutual trust by providing the finest legal services, through developing and improving the level of work and services provided to meet all legal requirements to the fullest extent.',
                ],
                'clients_title' => [
                    'ar' => 'عملائنا',
                    'en' => 'Our Clients',
                ],
                'clients_content' => [
                    'ar' => 'نفخر بعضويتنا في أبرز المنظمات القانونية المحلية والدولية، مما يعزز من قدراتنا ويوسع شبكة علاقاتنا المهنية.',
                    'en' => 'We are proud of our membership in the most prominent local and international legal organizations, which enhances our capabilities and expands our professional network.',
                ],
                'goals_title' => [
                    'ar' => 'هدفنا',
                    'en' => 'Our Goal',
                ],
                'goals_content' => [
                    'ar' => 'نفتخر بمسيرة حافلة بالإنجازات منذ تأسيسنا، حيث قدمنا خدمات قانونية متميزة لمئات العملاء في مختلف القطاعات.',
                    'en' => 'We are proud of our rich history of achievements since our establishment, having provided distinguished legal services to hundreds of clients across various sectors.',
                ],
                'is_active' => true,
            ]
        );
    }
}
