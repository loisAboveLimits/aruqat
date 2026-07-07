import { useState, useEffect, useRef } from 'react';
import { useLanguage } from '@/i18n/LanguageContext';
import SectionHeader from '@/components/SectionHeader';
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  type CarouselApi,
} from "@/components/ui/carousel";
import Autoplay from "embla-carousel-autoplay";
import team1 from '@/assets/team-1.jpg';
import team2 from '@/assets/team-2.jpg';
import team3 from '@/assets/team-3.jpg';

const teamImages = [team1, team2, team3];

const Team = ({ dynamicTeam, hideDiscover = false }: { dynamicTeam?: any[], hideDiscover?: boolean }) => {
  const { t, lang } = useLanguage();
  const teamMembers = dynamicTeam || t.team.members;
  const [api, setApi] = useState<CarouselApi>();
  const [current, setCurrent] = useState(0);
  const autoplayPlugin = useRef(
    Autoplay({ delay: 3000, stopOnInteraction: false })
  );

  useEffect(() => {
    if (!api) {
      return;
    }

    setCurrent(api.selectedScrollSnap());

    api.on("select", () => {
      setCurrent(api.selectedScrollSnap());
    });
  }, [api]);

  return (
    <section id="team" className="py-10 bg-background">
      <div className="container">
        <SectionHeader 
          badge={t.team.badge} 
          linkText={hideDiscover ? undefined : t.team.discover} 
          linkHref="/about-us" 
        />

        <Carousel
          setApi={setApi}
          opts={{ loop: true, align: "start", direction: lang === 'ar' ? 'rtl' : 'ltr' }}
          plugins={[autoplayPlugin.current]}
          className="w-full mx-auto mt-14"
        >
          <CarouselContent className="-ml-4 md:-ml-6">
            {teamMembers.map((member: any, i: number) => {
              const name = (typeof member.name === 'object' ? member.name[lang] : member.name);
              const position = (typeof member.position === 'object' ? member.position[lang] : member.position);
              const imageUrl = member.photo_url || teamImages[i % teamImages.length];

              return (
                <CarouselItem key={i} className="pl-4 md:pl-6 md:basis-1/2 lg:basis-1/3">
                  <div className="bg-card rounded-3xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg h-full">
                    <div className="p-6 pb-0">
                      <img
                        src={imageUrl}
                        alt={name}
                        className="w-full h-72 md:h-80 object-cover rounded-2xl"
                        loading="lazy"
                      />
                    </div>
                    <div className="p-6">
                      <h3 className="text-foreground font-bold text-xl mb-3">{name}</h3>
                      <p className="text-foreground text-sm">{position}</p>
                    </div>
                  </div>
                </CarouselItem>
              );
            })}
          </CarouselContent>
        </Carousel>

        {/* Dots */}
        <div className="flex items-center justify-center gap-2 mt-10">
          {teamMembers.map((_: any, i: number) => (
            <button
              key={i}
              onClick={() => api?.scrollTo(i)}
              className={`w-3.5 h-3.5 rounded-full transition-all duration-300 ${i === current ? 'bg-[#9EC0FF]' : 'bg-[#F8F8F8] hover:bg-[#9EC0FF]/50'
                }`}
              aria-label={`Go to slide ${i + 1}`}
            />
          ))}
        </div>
      </div>
    </section>
  );
};

export default Team;
