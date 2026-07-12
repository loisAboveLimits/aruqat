import { useLanguage } from '@/i18n/LanguageContext';
import { usePage } from '@inertiajs/react';
import heroBg from '@/assets/hero_bg.png';
import hero_overlay from '@/assets/hero_overlay.png';
import hero_video_desktop from '@/assets/videos/banner-video-desktop.mp4';
import hero_video_mobile from '@/assets/videos/banner-video-mobile.mp4';

const Hero = () => {
  const { t } = useLanguage();
  const { props } = usePage();
  const heroData = (t as any).heroData;
  const bgImage = heroData?.background_image_url || heroBg;
  const isAdmin = (props.auth as any)?.user;

  return (
    <section id="home" className="relative min-h-screen flex items-center justify-center overflow-hidden pb-24 pt-24">
     {/* 
      <div
        className="absolute inset-0 bg-cover bg-center"
        style={{ backgroundImage: `url(${bgImage})`, backgroundSize: "cover", backgroundPosition: "center" }}
      />

      <div className="absolute inset-0" style={{ backgroundImage: `url(${hero_overlay})`, backgroundSize: "cover", backgroundPosition: "center" }} />

      */}

      <div class="banner-video absolute">

        <div class="desktop-view">

          <div class="ratio ratio-16x9">

            <video 
              autoPlay={true}
              loop={true}
              muted={true}
              playsInline={true}
             >

              <source src={hero_video_desktop} type="video/mp4" />
                Your browser does not support the video tag.
            </video>             

          </div>

        </div> 

        <div class="mobile-view">
          
          <div class="ratio ratio-16x9">

            <video 
              autoPlay={true}
              loop={true}
              muted={true}
              playsInline={true}
             >

              <source src={hero_video_mobile} type="video/mp4" />
                Your browser does not support the video tag.
            </video>             

          </div>

        </div>     

      </div>


      <div className="relative z-10 container text-center mt-24">
        <h1 className="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-primary-foreground leading-tight mb-10 animate-fade-in-up">
          {t.hero.title}
        </h1>
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href={heroData?.cta_url || "#services"} className="inline-flex items-center justify-center px-10 py-2.5 rounded-full font-semibold text-base transition-all duration-300 bg-primary text-primary-foreground hover:opacity-90 min-w-[200px]">
            {t.hero.cta}
          </a>
          <a href={heroData?.secondary_cta_url || "#contact"} className="inline-flex items-center justify-center px-10 py-2.5 rounded-full font-semibold text-base transition-all duration-300 bg-secondary text-secondary-foreground hover:opacity-90 min-w-[200px]">
            {t.hero.secondary}
          </a>
        </div>
      </div>
    </section>
  );
};

export default Hero;
