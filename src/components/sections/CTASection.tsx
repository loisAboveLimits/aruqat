import { useLanguage } from '@/i18n/LanguageContext';
import { Link } from '@inertiajs/react';
import { FaInstagram, FaLinkedinIn, FaXTwitter, FaFacebookF } from 'react-icons/fa6';
import footerBg from '@/assets/footer_bg.png';
import mapImg from '@/assets/map.png';
import logo from '@/assets/logo.svg';
import title_vector from '@/assets/title_vector.svg';
import tqnia_logo from '@/assets/tqnia_logo.png';

const CTASection = () => {
  const { t, lang, settings } = useLanguage() as any;

  return (
    <section id="contact" className="relative mt-24" style={{ backgroundColor: '#172148' }}>
      {/* Background Image */}
      <div
        className="absolute inset-0 bg-cover bg-center z-0"
        style={{ backgroundImage: `url(${footerBg})`, backgroundPosition: 'right top', backgroundSize: 'auto', backgroundRepeat: 'no-repeat' }}
      />

      <div className="relative z-10 container pt-24 pb-0">
        <div className="flex flex-col lg:flex-row justify-between items-center lg:items-center gap-12 mb-20 lg:mb-32">

          {/* Text and Button Side (RTL Default Right, so place first in DOM) */}
          <div className="w-full lg:w-1/2 flex flex-col items-start text-start order-1">
            <div className="flex items-start gap-3">
              <img src={title_vector} alt="title_vector" className="lg:w-12 lg:h-12 w-8 h-8 mt-3" />
              <h2 className="text-3xl md:text-4xl lg:text-5xl font-light text-white mb-8 leading-tight whitespace-pre-line" style={{ lineHeight: '1.6' }}>
                {t.cta.title}
              </h2>
            </div>

            <Link href="/contact" className="inline-flex items-center justify-center px-10 lg:px-20 py-3 rounded-full font-semibold text-lg transition-all duration-300 bg-[#C4C4C4] text-[#192149] hover:bg-white min-w-[150px]" style={{ marginRight: '60px' }}>
              {t.cta.button}
            </Link>
          </div>

          {/* Map Side (RTL Default Left, so place second in DOM) */}
          <div className="w-full lg:w-1/2 flex justify-center lg:justify-end order-2">
            <div className="relative w-full">
              <img src={mapImg} alt="Saudi Arabia Map" className="w-[100%] object-contain" />
              {/* Clickable area for Jeddah location */}
              <a 
                href="https://maps.app.goo.gl/zvDUhDqZFQG2B8KdA?g_st=iwb"
                target="_blank"
                rel="noopener noreferrer"
                className="absolute cursor-pointer"
                style={{
                  top: '42%',
                  left: '13%',
                  width: '20%',
                  height: '25%',
                }}
                title="موقعنا في جدة"
                aria-label="Jeddah Location"
              ></a>
            </div>
          </div>

        </div>

        {/* Footer Area */}
        <div className="flex flex-col md:flex-row justify-between items-start gap-10 lg:gap-20">
          {/* Logo & Info (Left Side) */}
          <div className="flex flex-col items-center md:items-start w-full md:max-w-md text-center md:text-start">
            {settings?.footer_logo_url ? (
              <img src={settings.footer_logo_url} alt={settings.site_name} className="h-[90px] w-auto mb-6 brightness-0 invert" />
            ) : (
              <div className="flex flex-col items-center md:items-start mb-6">
                <img src={logo} alt="Logo" className="h-[60px] w-auto mb-2 brightness-0 invert opacity-50" />
                <span className="text-white text-2xl font-bold tracking-tight">{settings?.site_name || "أروقة النظام"}</span>
              </div>
            )}
            <p className="text-white/90 text-sm md:text-base leading-relaxed max-w-[400px]">
              {settings?.footer?.description || t.footer.description}
            </p>
          </div>

          {/* Socials & Nav Links (Right Side) */}
          <div className="flex flex-col gap-10 w-full md:w-auto mb-2 ">

            {/* Nav Links */}
            <div className="flex gap-16 justify-content-center" style={{ justifyContent: 'center' }}>
              {settings?.footer?.nav && settings.footer.nav.length > 0 ? (
                <>
                  <ul className="space-y-4">
                    {settings.footer.nav.slice(0, Math.ceil(settings.footer.nav.length / 2)).map((item: any, idx: number) => (
                      <li key={idx}><Link href={item.url} className="text-white hover:text-white/80 text-base font-medium transition-colors">{item.label}</Link></li>
                    ))}
                  </ul>
                  <ul className="space-y-4">
                    {settings.footer.nav.slice(Math.ceil(settings.footer.nav.length / 2)).map((item: any, idx: number) => (
                      <li key={idx}><Link href={item.url} className="text-white hover:text-white/80 text-base font-medium transition-colors">{item.label}</Link></li>
                    ))}
                  </ul>
                </>
              ) : (
                <>
                  <ul className="space-y-4">
                    <li><Link href="/about-us" className="text-white hover:text-white/80 text-base font-medium transition-colors">{t.nav.about}</Link></li>
                    <li><Link href="/contact" className="text-white hover:text-white/80 text-base font-medium transition-colors">{t.nav.contact}</Link></li>
                  </ul>
                  <ul className="space-y-4">
                    <li><Link href="/services" className="text-white hover:text-white/80 text-base font-medium transition-colors">{t.nav.services}</Link></li>
                    <li><Link href="/blog" className="text-white hover:text-white/80 text-base font-medium transition-colors">{t.nav.articles}</Link></li>
                  </ul>
                </>
              )}
            </div>

          </div>

        </div>

        {/* Bottom Bar: Copyright & Social Icons */}
        <div className="mt-8 pt-8 flex flex-col md:flex-row items-center justify-between gap-6">

          <div className="flex items-center">
            <p className="text-white/60 text-md">
              {settings?.footer?.copyright || t.footer.rights}
            </p>
          </div>

          {/* tqnia copyright */}

          <div className="flex items-center gap-2 hideThis">
            <p className="text-white/60 text-md">
              {lang === 'ar' ? 'تم التطوير بواسطة' : 'Developed by'}
            </p>
            <a href='https://www.tqniait.com/' target='_blank' rel='noopener noreferrer'><img src={tqnia_logo} alt="Tqnia Logo" className="h-4 w-auto brightness-0 invert opacity-60" /></a>
          </div>

          {/* Socials Icons (Left Side in RTL) */}
          <div className="flex items-center gap-2" style={{ flexDirection: 'row-reverse' }}>
            <a href={settings?.social?.instagram || "#"} target="_blank" rel="noopener noreferrer" className="w-14 h-24 rounded-t-full rounded-b-none border border-white-400 border-b-0 flex items-start justify-center pt-5 text-[#9EC0FF] hover:text-white hover:border-white transition-colors">
              <FaInstagram size={20} />
            </a>
            <a href={settings?.social?.linkedin || "#"} target="_blank" rel="noopener noreferrer" className="w-14 h-24 rounded-t-full rounded-b-none border border-white-400 border-b-0 flex items-start justify-center pt-5 text-[#9EC0FF] hover:text-white hover:border-white transition-colors">
              <FaLinkedinIn size={20} />
            </a>
            <a href={settings?.social?.x || "#"} target="_blank" rel="noopener noreferrer" className="w-14 h-24 rounded-t-full rounded-b-none border border-white-400 border-b-0 flex items-start justify-center pt-5 text-[#9EC0FF] hover:text-white hover:border-white transition-colors">
              <FaXTwitter size={20} />
            </a>
            <a href={settings?.social?.facebook || "#"} target="_blank" rel="noopener noreferrer" className="w-14 h-24 rounded-t-full rounded-b-none border border-white-400 border-b-0 flex items-start justify-center pt-5 text-[#9EC0FF] hover:text-white hover:border-white transition-colors">
              <i class="fa-brands fa-whatsapp"></i>
            </a>
          </div>

        </div>
      </div>
    </section>
  );
};

export default CTASection;
