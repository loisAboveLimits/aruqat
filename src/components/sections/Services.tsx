import { useLanguage } from '@/i18n/LanguageContext';
import SectionHeader from '@/components/SectionHeader';
import { PenTool } from 'lucide-react';

const Services = ({ dynamicServices }: { dynamicServices?: any[] }) => {
  const { t, lang } = useLanguage();
  const services = dynamicServices || t.services.items;
  const isAdmin = true; // Temporary for development, should use auth logic if available

  return (
    <section id="services" className="py-20 bg-background relative group">
      <div className="container">
        <SectionHeader badge={t.services.title} linkText={t.services.allServices} linkHref="/services" />

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-14">
          {services.map((item: any, i: number) => {
            const title = (typeof item.title === 'object' ? item.title[lang] : item.title);
            return (
              <div key={i} className="bg-muted/30 rounded-[1.5rem] p-6 flex flex-col justify-between min-h-[180px] md:min-h-[220px] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg border border-transparent hover:border-primary/10">
                <div className="flex justify-start mb-4">
                  <div className="w-14 h-14 overflow-hidden flex items-center justify-center">
                    {item.icon_url ? (
                      <img src={item.icon_url} alt={title} className="w-14 h-14 object-contain" />
                    ) : (
                      <div className="w-10 h-10 bg-primary/10 rounded-full" />
                    )}
                  </div>
                </div>
                <div>
                  <h3 className="text-foreground font-bold text-xl leading-tight lg:max-w-[81%]">
                    {title}
                  </h3>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
};

export default Services;
