<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => [
                    'ar' => 'الاستشارات القانونية',
                    'en' => 'Legal Consultations',
                ],
                'description' => [
                    'ar' => "هناك استشارات قانونية تتطلب استكشاف رأي القانون في صدد مسألة معينة قد تكون محل نزاع جدي أمام القضاء، أو نزاع يمكن أن يقع مستقبلا، ويهدف هذا المجال الى معرفة الحكم والوقوف على احتمالات صدور حكم لصالح طالب الاستشارة من عدمه وقد تضمن صياغة العقود في قوالبها القانونية السليمة للأفراد حقوقهم.\n\n1. يتمتع المستشارون والمحامون القانونيون المتخصصون لدى شركة أروقة النظام بخبرة ودراية متعددة الاختصاصات لتلبية متطلباتكم القانونية من خلال تزويدكم باستشارات وابداء الرأي القانوني في المجالات ذات الصلة بمتطلبات العميل.\n\n2. تقدم استشارات طبقا لراحة العميل سواء مكتبية داخل مقر الشركة أو عن بعد عن طريق الموقع الالكتروني للشركة.",
                    'en' => "There are legal consultations that require exploring the opinion of the law regarding a specific issue that may be the subject of a serious dispute before the judiciary, or a dispute that may occur in the future. This field aims to know the ruling and stand on the possibilities of issuing a ruling in favor of the consultation seeker or not. It included drafting contracts in their sound legal templates for individuals' rights.\n\n1. Specialized legal consultants and lawyers at Aruqat Al-Nizam Company have multi-disciplinary experience and knowledge to meet your legal requirements by providing you with consultations and legal opinions in fields related to the client's requirements.\n\n2. Consultations are provided at the client's convenience, whether office-based within the company's headquarters or remotely through the company's website.",
                ],
                'icon' => 'BookOpen',
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'ar' => 'التعاقد السنوي مع الشركات',
                    'en' => 'Annual Corporate Contracting',
                ],
                'description' => [
                    'ar' => "من أبرز أعمال شركة أروقة النظام للمحاماة والاستشارات القانونية التعاقد مع الشركات البارزة بالمملكة العربية السعودية وابرام الاتفاقيات السنوية معهم وتقديم المشورة القانونية والشرعية للشركات وتقديم الدعم الفني والقانوني فيما يخص العقود الخاصة بالشركة لما لنا من قدرة فائقة حيال تلبية احتياجات العملاء فضلاً عن الكفاءة والمرونة في العمل.",
                    'en' => "One of the most prominent works of Aruqat Al-Nizam Law Firm and Legal Consultations is contracting with prominent companies in the Kingdom of Saudi Arabia, concluding annual agreements with them, providing legal and Sharia advice to companies, and providing technical and legal support regarding the company's contracts due to our great ability to meet customer needs as well as efficiency and flexibility in work.",
                ],
                'icon' => 'Stamp',
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'ar' => 'التقاضي وتسوية المنازعات',
                    'en' => 'Litigation and Dispute Resolution',
                ],
                'description' => [
                    'ar' => "ان مجال التقاضي وتسوية المنازعات يتطلب خبرة عريقة ومعرفة متجددة بمتطلبات العملاء واحتياجاتهم، من أجل تسوية النزاعات والخلافات على نحو يتسم بأعلى الدرجات ولدينا خبرة واسعة في الترافع في جميع القضايا:\n\n- قضايا الاحوال الشخصية\n- القضايا التجارية\n- القضايا الجنائية\n- القضايا العمالية\n- القضايا الإدارية\n- التنفيذ",
                    'en' => "The field of litigation and dispute resolution requires long-standing experience and renewed knowledge of customer requirements and needs, in order to settle disputes and disagreements in a manner characterized by the highest degrees, and we have extensive experience in litigation in all cases:\n\n- Personal status cases\n- Commercial cases\n- Criminal cases\n- Labor cases\n- Administrative cases\n- Execution",
                ],
                'icon' => 'Gavel',
                'sort_order' => 3,
            ],
            [
                'title' => [
                    'ar' => 'التحكيم والوساطة',
                    'en' => 'Arbitration and Mediation',
                ],
                'description' => [
                    'ar' => "يشهد العالم زيادة في استخدام طرائق غير قضائية لتسوية النزاعات، وذلك نتيجة سعي العملاء لاتباع الطرائق السريعة ومن الخدمات التي يتم تقديمها في هذا الصدد:\n\n1. تقديم خدمات الوساطة والتحكيم والتصالح وغيرها من السبل غير القضائية لتسوية المنازعات.\n\n2. معاونة العملاء في اختيار آلية التسوية البديلة، وصياغة بنود عقود الحلول البديلة لتسوية، وتمثيل العملاء فيها.\n\n3. صياغة بنود الوساطة والتحكيم وفضها، في عقود التوظيف، واتفاقيات المشاريع المشاركة، واتفاقيات الترخيص، والعقود التجارية الأخرى.",
                    'en' => "The world is witnessing an increase in the use of non-judicial methods to settle disputes, as a result of customers' desire to follow fast methods. Services provided in this regard include:\n\n1. Providing mediation, arbitration, reconciliation, and other non-judicial methods for settling disputes.\n\n2. Assisting clients in choosing alternative settlement mechanisms, drafting clauses for alternative solution contracts for settlement, and representing clients in them.\n\n3. Drafting and resolving mediation and arbitration clauses in employment contracts, joint venture agreements, licensing agreements, and other commercial contracts.",
                ],
                'icon' => 'Scale',
                'sort_order' => 4,
            ],
            [
                'title' => [
                    'ar' => 'الأوراق التجارية والافلاس والتأمين',
                    'en' => 'Commercial Papers, Bankruptcy, and Insurance',
                ],
                'description' => [
                    'ar' => "1. تقديم الاستشارات النظامية وايضاح طريقة التعامل القانونية مع الأوراق التجارية ابتداء من تحريرها وانتهاء بالإجراءات الصحيحة لاستيفاء الحق عن طريقها.\n\n2. تقديم الاستشارات القانونية في الافلاس، وتشمل الرد على المصفين والمستقبلين والدائنين والمدينين، وجميع حالات الافلاس، والادارة والحراسة القضائية، والتصفية والتسويات الادارية.\n\n3. صياغة عقود التأمين ومراجعتها، وهي التي تبرمها الشركات التجارية أو يبرمها الأفراد مع شركات التأمين لإعداد صياغة نظامية شرعية تضمن كافة الحقوق، اضافة الى متابعة تحصيل التعويضات والمطالبات أمام اللجان.",
                    'en' => "1. Providing legal consultations and clarifying the legal method of dealing with commercial papers from their issuance to the correct procedures for fulfilling rights through them.\n\n2. Providing legal consultations in bankruptcy, including responding to liquidators, receivers, creditors and debtors, and all cases of bankruptcy, administration and judicial receivership, liquidation and administrative settlements.\n\n3. Drafting and reviewing insurance contracts, which are concluded by commercial companies or individuals with insurance companies to prepare a Sharia legal drafting that guarantees all rights, in addition to following up on collecting compensations and claims before the committees.",
                ],
                'icon' => 'ShieldCheck',
                'sort_order' => 5,
            ],
            [
                'title' => [
                    'ar' => 'التركات والوصايا',
                    'en' => 'Inheritances and Wills',
                ],
                'description' => [
                    'ar' => "في المملكة العربية السعودية يطبق على نظام الوصايا والتركات أحكام الشريعة الإسلامية الغراء في إجراءاتها وقسمتها سواء بالتراضي أو جبرا عن طريق المحاكم ونظر النزاعات فيها، وغالبا ما ترتبط هذه الخلافات بالأموال.\n\nوتبقى الآثار الشرعية والنظامية لكل شخص بعد وفاته من قسمة التركة من أموال ومنقولات وسداد الديون وتحصيلها وتنفيذ الوصايا والأوقاف واستخراج حصر الورثة ونقل الملكيات والسائل عنها والبحث عن التركات وغيرها الكثير. ونظراً لما نتمتع به من خبرات واسعة في مجال التركات والوصايا نقوم بتسخيرها لخدمة موكلينا ونمتلك فريق عمل متكامل ومتخصص لهذه الأعمال كما يتم صياغة الوصايا وتوثيقها.",
                    'en' => "In the Kingdom of Saudi Arabia, the system of wills and inheritances applies the provisions of the noble Islamic Sharia in its procedures and division, whether by mutual consent or forcibly through the courts and hearing disputes in them, and these disputes are often related to money.\n\nThe Sharia and legal effects remain for every person after their death from the division of the inheritance of money and movables, paying debts and collecting them, implementing wills and endowments, issuing heirship restriction, transferring titles, asking about them, searching for inheritances and many more. Given our extensive experience in the field of inheritances and wills, we harness it to serve our clients and we have an integrated and specialized work team for these works, as well as drafting and documenting wills.",
                ],
                'icon' => 'PenTool',
                'sort_order' => 6,
            ],
            [
                'title' => [
                    'ar' => 'صياغة واعداد وتدقيق العقود والاتفاقيات',
                    'en' => 'Drafting, Preparing, and Auditing Contracts and Agreements',
                ],
                'description' => [
                    'ar' => "نسعى دائماً لتقديم الدعم لعملائنا الكرام من خلال تقديم الاستشارات القانونية والشرعية لضبط جميع تصرفاتهم القانونية ومعاملاتهم التجارية لما للاستشارات من دور وقائي مهم قبل الشروع في العمل أو التصرف القانوني أو أثناء ابرامه مما يوفر الجهد والوقت والمال على العميل.\n\nوحيث في بداية العلاقات والشراكات غالباً ما تكون الأطراف منجذبة ويغلفها التسرع ولا يحصل فيها التروي والتدقيق وكتابة التفاصيل، ومن هنا تكمن الحاجة إلى صياغة العقود والاتفاقيات ومراجعتها وتدقيقها.",
                    'en' => "We always strive to provide support to our valued clients by providing legal and Sharia consultations to control all their legal actions and commercial transactions. Consultations play an important preventive role before starting work or legal action or during its conclusion, which saves effort, time and money for the client.\n\nSince at the beginning of relationships and partnerships, the parties are often attracted and enveloped in haste, and there is no deliberation, auditing and writing details. From here lies the need for drafting, reviewing and auditing contracts and agreements.",
                ],
                'icon' => 'FileText',
                'sort_order' => 7,
            ],
            [
                'title' => [
                    'ar' => 'التوثيق',
                    'en' => 'Notarization',
                ],
                'description' => [
                    'ar' => "التوثيق هو مجموعة من الإجراءات التي تكفل اثبات الحق على وجه يصح الاحتجاج به وفقاً للأحكام النظام. والموثق هو من يقوم بأعمال التوثيق بموجب رخصة صادرة من جهة الاختصاص وفق أحكام النظام. من خدمات موثقينا وفق أحكام النظام للتوثيق ما يأتي:\n\n1. إفراغ ضكوك الملكية العقارية وفقاً لما تبینه اللائحة.\n2. إصدار الوكالات وفسخها.\n3. الرهن وفكه وتعديله.\n4. عقود تأسيس الشركات، وملاحق التعديل، وقرارات ذوي الصلاحيات فيها.\n5. محاضر الجمعيات العمومية للشركات.\n6. التصرفات والعقود الواقعة على العلامات التجارية، وبراءات الاختراع وحقوق المؤلف.",
                    'en' => "Notarization is a set of procedures that ensure the proof of the right in a way that is valid to be invoked according to the provisions of the system. A notary public is one who performs notarization acts under a license issued by the competent authority according to the provisions of the system. Services of our notaries according to the provisions of the system for notarization include:\n\n1. Transfer of real estate title deeds according to what the regulations show.\n2. Issuing and canceling powers of attorney.\n3. Mortgage, its release and amendment.\n4. Articles of association of companies, amendment annexes, and decisions of those with authority therein.\n5. Minutes of general assemblies of companies.\n6. Dispositions and contracts involving trademarks, patents, and copyrights.",
                ],
                'icon' => 'CheckCircle',
                'sort_order' => 8,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(
                ['title->ar' => $serviceData['title']['ar']],
                $serviceData
            );
        }
    }
}
