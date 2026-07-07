import { useLanguage } from '@/i18n/LanguageContext';
import { usePage } from '@inertiajs/react';
import SectionHeader from '@/components/SectionHeader';
import aboutImg from '@/assets/about_img.png';

const About = () => {
  const { t } = useLanguage();
  const { props } = usePage();
  const aboutData = (t as any).aboutData;
  const imageUrl = aboutData?.office_image_url || aboutImg;
  const isAdmin = (props.auth as any)?.user;

  return (
    <section id="about" className="py-12 md:py-20 bg-background relative">
      <div className="container px-4">
        <div className="flex flex-col lg:flex-row items-stretch gap-10 lg:gap-16">
          {/* Image side */}
          <div className="flex-1 order-1 lg:order-none">
            <div className="rounded-2xl overflow-hidden h-full min-h-[200px] lg:min-h-[400px]">
              <img
                src={imageUrl}
                alt="About Arwqat Al Netham"
                className="w-full h-full object-cover"
                loading="lazy"
              />
            </div>
          </div>
          {/* Text side */}
          <div className="flex-1 order-2 lg:order-none flex flex-col justify-center">
            <SectionHeader badge={t.about.badge} />
            {/* <h2 className="text-3xl md:text-4xl font-bold mb-6 text-foreground">
              {t.about.title}
            </h2> */}
            <div className="text-muted-foreground leading-relaxed text-xl md:text-2xl mb-8 font-light max-w-lg text-center md:text-start" dangerouslySetInnerHTML={{ __html: t.about.description1 }} />

            <a href={aboutData?.cta_url || "#"} className="text-md font-bold text-foreground underline underline-offset-4 hover:text-navy-light transition-colors text-center md:text-start">
              {t.about.cta}
            </a>
          </div>
        </div>
      </div>
    </section>
  );
};

export default About;
