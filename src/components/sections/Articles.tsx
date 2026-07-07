import { useState, useEffect, useRef } from 'react';
import { Link } from '@inertiajs/react';
import { useLanguage } from '@/i18n/LanguageContext';
import SectionHeader from '@/components/SectionHeader';
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  type CarouselApi,
} from "@/components/ui/carousel";
import Autoplay from "embla-carousel-autoplay";
import article1 from '@/assets/article-1.jpg';
import article2 from '@/assets/article-2.jpg';
import article3 from '@/assets/article-3.jpg';

const articleImages = [article1, article2, article3];

const Articles = ({ dynamicArticles }: { dynamicArticles?: any[] }) => {
  const { t, lang, localize } = useLanguage() as any;
  const articles = dynamicArticles || t.articles.items;
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
    <section id="articles" className="py-10 md:py-28 bg-background overflow-hidden">
      <div className="container">
        <SectionHeader badge={t.articles.badge} linkText={t.articles.readMore} linkHref="/blog" />

        <Carousel
          setApi={setApi}
          opts={{ loop: true, align: "start", direction: lang === 'ar' ? 'rtl' : 'ltr' }}
          plugins={[autoplayPlugin.current]}
          className="w-full mx-auto articals_slider"
        >
          <CarouselContent className="-ml-4 md:-ml-6">
            {articles.map((article: any, i: number) => {
              const title = localize(article.title);
              const imageUrl = article.cover_url || articleImages[i % articleImages.length];
              const articleId = article.slug || article.id;

              return (
                <CarouselItem key={i} className="pl-4 md:pl-6 md:basis-1/2 lg:basis-1/3">
                  <article className="bg-card bg-transparent rounded-3xl overflow-hidden border border-[#575757] transition-all duration-300 hover:border-primary hover:-translate-y-2 transition-all duration-300 h-full flex flex-col ">
                    <div className="p-5 pb-0">
                      <img
                        src={imageUrl}
                        alt={title}
                        className="w-full h-[250px] object-cover rounded-3xl"
                        loading="lazy"
                      />
                    </div>
                    <div className="p-6 flex flex-col flex-grow">
                      <h3 className="text-muted-foreground font-bold text-2xl mb-20 leading-relaxed">{title}</h3>
                      <Link href={`/blog/${articleId}`} className="text-sm font-bold text-foreground underline underline-offset-4 hover:text-navy-light transition-colors mt-auto">
                        {t.articles.readMore}
                      </Link>
                    </div>
                  </article>
                </CarouselItem>
              );
            })}
          </CarouselContent>
        </Carousel>

        {/* Dots */}
        <div className="flex items-center justify-center gap-2 mt-10">
          {articles.map((_: any, i: number) => (
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

export default Articles;
