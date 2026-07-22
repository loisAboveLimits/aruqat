import { useForm, usePage, Head } from '@inertiajs/react';
import { useLanguage } from '@/i18n/LanguageContext';
import { useRef } from 'react';
import Header from '@/components/sections/Header';
import CTASection from '@/components/sections/CTASection';
import contactHero from '@/assets/contact_hero.png';
import calendarIcon from '@/assets/calendar_icon.png';
import clockIcon from '@/assets/clock_icon.png';
import { FaMapMarkerAlt, FaPhoneAlt, FaEnvelope } from 'react-icons/fa';
import { toast } from '@/components/ui/use-toast';
import hero_overlay from '@/assets/hero_overlay.png';

const ContactPage = () => {
  const { t, lang, settings, localize } = useLanguage() as any;
  const { props } = usePage();
  const services = (props.services as any[]) || [];

  const dateInputRef = useRef<HTMLInputElement>(null);
  const timeInputRef = useRef<HTMLInputElement>(null);

  const { data, setData, post, processing, errors, reset } = useForm({
    full_name: '',
    email: '',
    phone: '',
    appointment_date: '',
    appointment_time: '',
    service: '',
    message: '',
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    post('/contact', {
      onSuccess: () => {
        toast({
          title: lang === 'ar' ? 'تم الإرسال!' : 'Sent!',
          description: lang === 'ar' ? 'تم إرسال رسالتك بنجاح.' : 'Your message has been sent successfully.',
        });
        reset();
      },
    });
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
          <meta property="og:image" content={seo?.og_image} />
      </Head>

      <Header />

      {/* Hero Section */}
      <section className="relative h-[400px] md:h-[500px] min-h-screen flex items-center justify-center">
        <div
          className="absolute inset-0 bg-cover bg-center"
          style={{ backgroundImage: `url(${settings?.contact_hero_url || contactHero})` }}
        />
        <div className="absolute inset-0" style={{ backgroundImage: `url(${hero_overlay})`, backgroundSize: "cover", backgroundPosition: "center" }} />
        <div className="relative z-10 text-center px-4">
          <h1 className="text-4xl md:text-6xl font-bold text-white tracking-wide animate-fade-in-up">
            {t.contactPage.heroTitle}
          </h1>
        </div>
      </section>

      {/* Form Section */}
      <section className="py-16 md:py-24 bg-white">
        <div className="container max-w-4xl px-4">
          <p className="text-center text-black mb-12 text-lg md:text-xl">
            {t.contactPage.formTitle}
          </p>

          <form onSubmit={handleSubmit} className="space-y-4">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <input
                type="text"
                value={data.full_name}
                onChange={e => setData('full_name', e.target.value)}
                placeholder={t.contactPage.fields.fullName}
                className="w-full px-6 py-4 bg-[#F8F8F8] border-none rounded-sm text-foreground focus:ring-2 focus:ring-primary/20 outline-none transition-all placeholder:text-foreground/40 rtl:text-right ltr:text-left"
              />
              <input
                type="email"
                value={data.email}
                onChange={e => setData('email', e.target.value)}
                placeholder={t.contactPage.fields.email}
                className="w-full px-6 py-4 bg-[#F8F8F8] border-none rounded-sm text-foreground focus:ring-2 focus:ring-primary/20 outline-none transition-all placeholder:text-foreground/40 rtl:text-right ltr:text-left"
              />
              <input
                type="tel"
                value={data.phone}
                onChange={e => setData('phone', e.target.value.replace(/[^0-9+]/g, ''))}
                placeholder={t.contactPage.fields.phone}
                className="w-full px-6 py-4 bg-[#F8F8F8] border-none rounded-sm text-foreground focus:ring-2 focus:ring-primary/20 outline-none transition-all placeholder:text-foreground/40 rtl:text-right ltr:text-left"
              />
              <div className="relative cursor-pointer" onClick={() => dateInputRef.current?.showPicker()}>
                <input
                  ref={dateInputRef}
                  type="date"
                  value={data.appointment_date}
                  onChange={e => setData('appointment_date', e.target.value)}
                  className="w-full px-16 py-4 bg-[#F8F8F8] border-none rounded-sm text-foreground focus:ring-2 focus:ring-primary/20 outline-none transition-all placeholder:text-foreground/40 rtl:text-right ltr:text-left appearance-none cursor-pointer"
                />
                <img src={calendarIcon} alt="" className="absolute ltr:right-5 rtl:left-5 top-1/2 -translate-y-1/2 w-6 h-6 object-contain pointer-events-none" />
                {!data.appointment_date && (
                  <span className="absolute ltr:left-6 rtl:right-6 top-1/2 -translate-y-1/2 text-foreground/40 pointer-events-none">
                    {t.contactPage.fields.date}
                  </span>
                )}
              </div>
              <div className="relative">
                <select
                  value={data.service}
                  onChange={e => setData('service', e.target.value)}
                  className="w-full px-6 py-4 bg-[#F8F8F8] border-none rounded-sm text-foreground focus:ring-2 focus:ring-primary/20 outline-none transition-all placeholder:text-foreground/40 rtl:text-right ltr:text-left appearance-none rtl:pr-6 ltr:pl-6 pr-10"
                >
                  <option value="" disabled>{t.contactPage.fields.service}</option>
                  {services.map((service: any) => (
                    <option key={service.id} value={localize(service.title)}>
                      {localize(service.title)}
                    </option>
                  ))}
                </select>
                <div className="absolute ltr:right-5 rtl:left-5 top-1/2 -translate-y-1/2 pointer-events-none">
                  <svg className="w-4 h-4 text-foreground/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 8l-7 7-7-7" />
                  </svg>
                </div>
              </div>
              <div className="relative cursor-pointer" onClick={() => timeInputRef.current?.showPicker()}>
                <input
                  ref={timeInputRef}
                  type="time"
                  value={data.appointment_time}
                  onChange={e => setData('appointment_time', e.target.value)}
                  className="w-full px-16 py-4 bg-[#F8F8F8] border-none rounded-sm text-foreground focus:ring-2 focus:ring-primary/20 outline-none transition-all placeholder:text-foreground/40 rtl:text-right ltr:text-left appearance-none cursor-pointer"
                />
                <img src={clockIcon} alt="" className="absolute ltr:right-5 rtl:left-5 top-1/2 -translate-y-1/2 w-6 h-6 object-contain pointer-events-none" />
                {!data.appointment_time && (
                  <span className="absolute ltr:left-6 rtl:right-6 top-1/2 -translate-y-1/2 text-foreground/40 pointer-events-none">
                    {t.contactPage.fields.time}
                  </span>
                )}
              </div>
            </div>
            <textarea
              value={data.message}
              onChange={e => setData('message', e.target.value)}
              placeholder={t.contactPage.fields.description}
              rows={5}
              className="w-full px-6 py-4 bg-[#F8F8F8] border-none rounded-sm text-foreground focus:ring-2 focus:ring-primary/20 outline-none transition-all placeholder:text-foreground/40 resize-none rtl:text-right ltr:text-left"
            />
            <button
              type="submit"
              disabled={processing}
              className="w-full py-4 bg-[#192149] text-white font-bold text-lg rounded-sm hover:bg-[#192149]/90 transition-colors shadow-lg disabled:opacity-50"
            >
              {t.contactPage.fields.submit}
            </button>
          </form>
        </div>
      </section>

      {/* Info Section */}
      <section className="py-0 lg:py-20 bg-white border-t border-gray-50">
        <div className="container px-4">
          <div className="max-w-4xl mx-auto space-y-16">
            <div className="flex flex-col items-center text-center">
              <div className="w-12 h-12 flex items-center justify-center text-[#9EC0FF] mb-4">
                <FaMapMarkerAlt size={32} />
              </div>
              <h3 className="text-xl font-bold text-[#192149] mb-3">{t.contactPage.info.addressTitle}</h3>
              <p className="text-[#787D82] leading-loose max-w-lg text-lg">
                {settings?.address || t.contactPage.info.address}
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-12">
              {/* Email */}
              <div className="flex flex-col items-center text-center">
                <div className="w-12 h-12 flex items-center justify-center text-[#9EC0FF] mb-4">
                  <FaEnvelope size={30} />
                </div>
                <h3 className="text-xl font-bold text-[#192149] mb-3">{t.contactPage.info.email}</h3>
                <a href={`mailto:${settings?.email || 'info@aruqatalnizam.com'}`} className="text-[#787D82] text-lg hover:text-primary transition-colors">
                  {settings?.email || 'info@aruqatalnizam.com'}
                </a>
              </div>

              {/* Phone */}
              <div className="flex flex-col items-center text-center">
                <div className="w-12 h-12 flex items-center justify-center text-[#9EC0FF] mb-4">
                  <FaPhoneAlt size={30} />
                </div>
                <h3 className="text-xl font-bold text-[#192149] mb-3">{t.contactPage.info.phone}</h3>
                <a href={`tel:${settings?.phone || '+966509111117'}`} className="text-[#787D82] text-lg hover:text-primary transition-colors" style={{ direction: 'ltr' }}>
                  {settings?.phone || '+966 50 911 1117'}
                </a>
              </div>
            </div>
          </div>
        </div>
      </section >

      <CTASection />
    </div >
  );
};

export default ContactPage;
