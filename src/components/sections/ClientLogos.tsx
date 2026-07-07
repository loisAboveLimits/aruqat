import { useRef } from 'react';
import { useLanguage } from '@/i18n/LanguageContext';
import { usePage } from '@inertiajs/react';
import title_vector from '@/assets/title_vector.svg';
import {
  Carousel,
  CarouselContent,
  CarouselItem,
} from "@/components/ui/carousel";
import Autoplay from "embla-carousel-autoplay";

interface ClientLogosProps {
  dynamicClientLogos?: any[];
}

const ClientLogos = ({ dynamicClientLogos }: ClientLogosProps) => {
  const { t, lang } = useLanguage();
  const { props } = usePage();
  const logos = dynamicClientLogos || (t as any).dynamicClientLogos || [];
  const isAdmin = (props.auth as any)?.user;

  const autoplayPlugin = useRef(
    Autoplay({ delay: 2000, stopOnInteraction: false, stopOnMouseEnter: true })
  );

  return (
    <section className="py-24 bg-white overflow-hidden relative">
      <div className="container mx-auto px-4">
        {/* Title Section */}
        <div className="flex items-center justify-center gap-4 mb-16">
          <img src={title_vector} alt="" className="w-10 h-10 md:w-12 md:h-12" />
          <h2 className="text-2xl md:text-4xl font-bold text-[#172148] text-center">
            {t.clients.badge}
          </h2>
          <img src={title_vector} alt="" className="w-10 h-10 md:w-12 md:h-12" />
        </div>

        <div className="relative w-full">
          <Carousel
            opts={{
              align: "start",
              loop: true,
              dragFree: true,
              direction: lang === 'ar' ? 'rtl' : 'ltr'
            }}
            plugins={[autoplayPlugin.current]}
            className="w-full"
          >
            <CarouselContent className="-ml-2">
              {logos.length > 0 ? logos.map((logo: any, i: number) => (
                <CarouselItem key={logo.id || i} className="pl-2 basis-1/3 md:basis-1/6 lg:basis-[183px] select-none touch-pan-y">
                  <div className="flex items-center justify-center rounded-none group" style={{ height: "157px" }}>
                    {logo.image_url ? (
                      <img
                        src={logo.image_url}
                        alt={logo.name || 'Client Logo'}
                        className="w-full h-full object-contain"
                      />
                    ) : (
                      <span className="text-[#172148] group-hover:text-primary font-bold text-xl md:text-2xl transition-all duration-500 text-center">
                        {localize(logo.name) || 'إعمار'}
                      </span>
                    )}
                  </div>
                </CarouselItem>
              )) : Array(8).fill(null).map((_, i) => (
                <CarouselItem key={i} className="pl-2 basis-1/2 md:basis-1/4 lg:basis-1/6 select-none touch-pan-y">
                  <div className="bg-[#F5F5F5] hover:bg-[#ECECEC] transition-all duration-300 flex items-center justify-center aspect-square rounded-none p-8 group">
                    <span className="text-[#172148] group-hover:text-primary font-bold text-xl md:text-2xl transition-all duration-500 text-center">
                      إعمار
                    </span>
                  </div>
                </CarouselItem>
              ))}
            </CarouselContent>
          </Carousel>
        </div>
      </div>
    </section>
  );
};

export default ClientLogos;
