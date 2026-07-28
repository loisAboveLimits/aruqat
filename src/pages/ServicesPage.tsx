import { useState } from 'react';
import { usePage, Head } from '@inertiajs/react';
import Header from '@/components/sections/Header';
import CTASection from '@/components/sections/CTASection';
import { useLanguage } from '@/i18n/LanguageContext';
import heroBg from '@/assets/hero_bg.png';
import hero_overlay from '@/assets/hero_overlay.png';
import title_vector from '@/assets/title_vector.svg';
import * as LucideIcons from 'lucide-react';

const ServicesPage = () => {
  const { t, lang, settings, localize } = useLanguage() as any;
  const { props } = usePage();
  const services = (props.services as any[]) || [];

  const items = services.length > 0 ? services : t.services.items;
  const [activeIndex, setActiveIndex] = useState(0);
  const activeItem = items[activeIndex] || items[0];

  const renderIcon = (item: any, isActive: boolean) => {
    if (item.icon_url) {
      return <img src={item.icon_url} alt="" className={`w-10 h-10 object-contain`} />;
    }
    const IconName = item.icon && (LucideIcons as any)[item.icon] ? (LucideIcons as any)[item.icon] : LucideIcons.FileText;
    return <IconName size={38} strokeWidth={1.5} className={'text-[#9EC0FF]'} />;
  };

  const seo = props.seo;

  return (
    <div className="min-h-screen">

    <Head>
        <title>{seo?.seo_title}</title>
        <meta name="description" content={seo?.seo_description}/>
        <meta name="keywords" content={seo?.seo_keywords}/>
        <link rel="canonical" href={seo?.canonical_url} />
        <meta property="og:title" content={seo?.seo_title} />
        <meta property="og:description" content={seo?.og_description} />
        <meta name="robots" content="index, follow"/>
    </Head>

      <Header />

      {/* Hero */}
      <section className="relative h-[400px] md:h-[500px] min-h-screen flex items-center justify-center">
        <div className="absolute inset-0 bg-cover bg-center" style={{ backgroundImage: `url(${settings?.services_hero_url || heroBg})` }} />
        <div className="absolute inset-0" style={{ backgroundImage: `url(${hero_overlay})`, backgroundSize: "cover", backgroundPosition: "center" }} />
        <div className="relative z-10 text-center">
          <h1 className="text-4xl md:text-6xl font-bold text-white tracking-wide animate-fade-in-up">
            {t.services.badge}
          </h1>
        </div>
      </section>

      {/* Services Content & Tabs */}
      <section className="py-16 bg-white relative overflow-hidden">
        <div className="container relative z-10">
          <div className="flex items-center gap-3 justify-start mb-8 md:mb-12">
            <img src={title_vector} alt="" className="w-10 h-10 md:w-12 md:h-12" />
            <h2 className="text-2xl md:text-3xl font-medium text-foreground">
              {t.services.title}
            </h2>
          </div>
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            {/* Right Column  */}
            <div className="lg:col-span-5">
              <div className="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 gap-2">
                {items.map((item: any, i: number) => {
                  const title = localize(item.title);
                  const isActive = activeIndex === i;
                  return (
                    <button
                      key={i}
                      onClick={() => {
                        setActiveIndex(i);
                        const element = document.getElementById('service-details');
                        if (element) {
                          // Different offset for mobile and desktop
                          const isMobile = window.innerWidth < 1024;
                          const yOffset = isMobile ? -150 : -220;

                          const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
                          window.scrollTo({ top: y, behavior: 'smooth' });
                        }
                      }}
                      className={`rounded-[2rem] p-4 pb-2 flex flex-col transition-all duration-300 min-h-[190px] justify-around ${isActive
                        ? 'bg-[#172148] text-white shadow-xl shadow-[#172148]/20 -translate-y-1'
                        : 'bg-[#F9FAFB] hover:bg-[#172148]/5 text-[#172148]'
                        }`}
                    >
                      <div className="mb-8 flex">
                        {renderIcon(item, isActive)}
                      </div>
                      <h3 className={`font-bold text-sm md:text-[20.47px] lg:max-w-[84%] text-start transition-colors ${isActive ? 'text-[#9EC0FF]' : 'text-[#172148]'}`} style={{ lineHeight: '23.75px' }}>
                        {title}
                      </h3>
                    </button>
                  )
                })}
              </div>
            </div>

            {/* Left Column */}
            <div id="service-details" className="lg:col-span-7 scroll-mt-[100px] lg:scroll-mt-[220px]">
              <div
                className="prose prose-lg max-w-none text-foreground leading-loose text-start bg-white"
                dangerouslySetInnerHTML={{ __html: localize(activeItem?.description) || '' }}
              />
            </div>

          </div>
        </div>
      </section>

      <CTASection />
    </div>
  );
};

export default ServicesPage;
