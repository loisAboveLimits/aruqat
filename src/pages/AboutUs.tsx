import { useState } from 'react';
import { usePage, Head } from '@inertiajs/react';
import Header from '@/components/sections/Header';
import Stats from '@/components/sections/Stats';
import Team from '@/components/sections/Team';
import CTASection from '@/components/sections/CTASection';
import { useLanguage } from '@/i18n/LanguageContext';
import heroBg from '@/assets/hero_bg.png';
import aboutImg from '@/assets/about_img.png';
import hero_overlay from '@/assets/hero_overlay.png';

const tabs = ['vision', 'clients', 'goals'] as const;

const AboutUs = () => {
  const { t, lang, settings, localize } = useLanguage() as any;
  const { props } = usePage();
  const aboutData = props.about as any;
  const [activeTab, setActiveTab] = useState<typeof tabs[number]>('vision');

  const heroTitle = (typeof aboutData?.hero_title === 'object' ? aboutData.hero_title[lang] : aboutData?.hero_title) || t.aboutPage.heroTitle;
  const content = (typeof aboutData?.content === 'object' ? aboutData.content[lang] : aboutData?.content) || t.aboutPage.paragraph1;
  const imageUrl = aboutData?.office_image_url || aboutImg;

  const dynamicTabs = [
    { id: 'vision', title: localize(aboutData?.vision_title, t.aboutPage.tabs.vision), content: localize(aboutData?.vision_content, t.aboutPage.tabContent.vision) },
    { id: 'clients', title: localize(aboutData?.clients_title, 'عملائنا'), content: localize(aboutData?.clients_content, t.aboutPage.tabContent.membership) },
    { id: 'goals', title: localize(aboutData?.goals_title, t.aboutPage.tabs.milestones), content: localize(aboutData?.goals_content, t.aboutPage.tabContent.milestones) },
  ];

  return (
    <div className="min-h-screen">
      <Head title={t.nav.about} />
      <Header />

      {/* Hero Section */}
      <section className="relative h-[400px] md:h-[500px] min-h-screen flex items-center justify-center">
        <div
          className="absolute inset-0 bg-cover bg-center"
          style={{ backgroundImage: `url(${(settings as any)?.about_hero_url || heroBg})` }}
        />
        <div className="absolute inset-0" style={{ backgroundImage: `url(${hero_overlay})`, backgroundSize: "cover", backgroundPosition: "center" }} />
        <div className="relative z-10 text-center">
          <h1 className="text-4xl md:text-6xl font-bold text-white tracking-wide animate-fade-in-up">
            {heroTitle}
          </h1>
        </div>
      </section>

      {/* About Content */}
      <section className="py-16 bg-background">
        <div className="container">
          <div
            className="prose prose-lg mx-auto text-muted-foreground leading-loose"
            dangerouslySetInnerHTML={{ __html: content }}
          />
        </div>
      </section>

      {/* Tabs Section */}
      <section className="py-16 md:py-20 bg-background">
        <div className="container">
          <div className="flex flex-col lg:flex-row items-stretch gap-10 lg:gap-16">
            {/* Image side */}
            <div className="flex-1">
              <div className="rounded-2xl overflow-hidden h-full max-h-[75vh]">
                <img
                  src={imageUrl}
                  alt="About"
                  className="w-full h-full object-cover object-center max-h-[75vh]"
                  loading="lazy"
                />
              </div>
            </div>

            {/* Text side */}
            <div className="flex-1 flex flex-col sticky h-fit" style={{ top: '120px' }}>
              {/* Tabs */}
              <div className="flex gap-2 mb-8">
                {dynamicTabs.map((tab) => (
                  <button
                    key={tab.id}
                    onClick={() => setActiveTab(tab.id as any)}
                    className={`px-6 flex-1 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 ${activeTab === tab.id
                      ? 'bg-foreground text-background'
                      : 'bg-card text-muted-foreground hover:bg-muted'
                      }`}
                  >
                    {tab.title}
                  </button>
                ))}
              </div>

              {/* Tab Content */}
              <div
                className="text-muted-foreground leading-relaxed text-base md:text-lg prose prose-sm lg:max-w-[85%]"
                dangerouslySetInnerHTML={{ __html: dynamicTabs.find(t => t.id === activeTab)?.content || '' }}
              />
            </div>
          </div>
        </div>
      </section>

      {/* Stats */}
      <Stats stats={props.stats as any[]} />

      {/* Team */}
      <Team dynamicTeam={props.team} hideDiscover={true} />

      {/* CTA & Footer */}
      <CTASection />
    </div>
  );
};

export default AboutUs;
