import { useLanguage } from '@/i18n/LanguageContext';
import { usePage } from '@inertiajs/react';
import visionBg from '@/assets/vision-bg.png';
import title_vector from '@/assets/title_vector.svg';
import SectionHeader from '../SectionHeader';

const Vision = () => {
  const { t, lang } = useLanguage();
  const { props } = usePage();
  const goalData = (t as any).goalData;
  const bgImage = goalData?.background_image_url || visionBg;
  const isAdmin = (props.auth as any)?.user;

  return (
    <section className="relative overflow-hidden">
      <div className="relative h-[400px] md:h-[450px]">
        <div
          className="absolute inset-0 bg-cover bg-center"
          style={{ backgroundImage: `url(${bgImage})` }}
        />
        <div className="absolute inset-0" style={{ background: 'linear-gradient(270deg, #192149 0%, rgba(0, 0, 0, 0) 186.7%)' }} />

        <div className="relative z-10 container h-full flex items-center px-14">
          <div className="max-w-xl text-start">
            <div className="flex items-center gap-3 justify-start mb-4">
              <img src={title_vector} alt="title_vector" className="w-12 h-12" />
              <span className="text-white text-lg font-medium">{t.vision.badge}</span>
            </div>
            <h2 className="text-2xl md:text-3xl lg:text-5xl font-light text-primary-foreground mb-6 whitespace-pre-line" style={{ lineHeight: '1.8' }}>
              {t.vision.title}
            </h2>
            {/* Removed Vision description */}
            <a href={goalData?.cta_url || "#"} className="text-sm font-medium text-primary-foreground underline underline-offset-4 hover:opacity-80 transition-opacity">
              {t.vision.cta}
            </a>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Vision;
