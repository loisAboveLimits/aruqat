<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $authorId = User::first()?->id ?? 1;

        $articles = [
            [
                'title' => [
                    'ar' => 'حقوق وواجبات الأفراد في القضايا الشائعة',
                    'en' => 'Rights and Duties of Individuals in Common Cases',
                ],
                'content' => [
                    'ar' => 'تعد معرفة الحقوق والواجبات القانونية من أهم الإجراءات التي يساعد الاعتماد على سجل من المعلومات من الالتزام بها. فالقضايا الشائعة تشمل طيفاً واسعاً من المشكلات اليومية كالنزاعات التعاقدية وإجراءات العمل والإيجارات وأنواع القضايا المختلفة.',
                    'en' => 'Understanding legal rights and obligations is one of the most important steps in ensuring compliance. Common cases cover a wide spectrum of everyday issues including contractual disputes, labor procedures, rental matters, and various other types of cases.',
                ],
                'slug' => 'rights-and-duties-of-individuals',
                'photo' => 'article-1.jpg',
            ],
            [
                'title' => [
                    'ar' => 'أخطاء قانونية يقع فيها أصحاب الشركات الناشئة',
                    'en' => 'Legal Mistakes Made by Startup Founders',
                ],
                'content' => [
                    'ar' => 'يرتكب كثير من رواد الأعمال أخطاء قانونية عند تأسيس شركاتهم الناشئة قد تكلفهم الكثير على المدى البعيد. فمن أبرز هذه الأخطاء عدم توثيق الاتفاقيات بين الشركاء، وإغفال حقوق الملكية الفكرية، وعدم الالتزام بالإجراءات الرسمية للتسجيل.',
                    'en' => 'Many entrepreneurs make legal mistakes when establishing their startups that can cost them dearly in the long run. Among the most notable mistakes are failure to document partnership agreements, overlooking intellectual property rights, and not following formal registration procedures.',
                ],
                'slug' => 'legal-mistakes-startup-founders',
                'photo' => 'article-2.jpg',
            ],
            [
                'title' => [
                    'ar' => 'شرح الأنظمة الجديدة في السعودية بطريقة مبسطة',
                    'en' => 'A Simple Explanation of New Saudi Regulations',
                ],
                'content' => [
                    'ar' => 'صدرت في المملكة العربية السعودية خلال السنوات الأخيرة حزمة من الأنظمة والتشريعات الجديدة التي تؤثر بشكل مباشر على حياة الأفراد والشركات. نهدف في هذا المقال إلى تبسيط أبرز هذه الأنظمة وتقديمها بأسلوب واضح ومفهوم.',
                    'en' => 'Saudi Arabia has issued a package of new regulations and legislation in recent years that directly impact the lives of individuals and businesses. In this article, we aim to simplify the most prominent of these regulations and present them in a clear and understandable way.',
                ],
                'slug' => 'new-saudi-regulations-simplified',
                'photo' => 'article-3.jpg',
            ],
        ];

        $assetsPath = base_path('src/assets');

        foreach ($articles as $data) {
            $post = BlogPost::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'slug' => $data['slug'],
                'author_id' => $authorId,
                'status' => 'published',
                'published_at' => now(),
            ]);

            $imagePath = $assetsPath . '/' . $data['photo'];
            if (File::exists($imagePath)) {
                $post->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('blog_covers');
            }
        }
    }
}
