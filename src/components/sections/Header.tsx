import { useState, useEffect } from 'react';
import { Link, usePage } from '@inertiajs/react';
import { useLanguage } from '@/i18n/LanguageContext';
import { Menu, X } from 'lucide-react';
import logo from '@/assets/logo.svg';

const Header = () => {
  const { t, toggleLanguage, lang, settings } = useLanguage() as any;
  const { props, url } = usePage();
  const isAdmin = (props.auth as any)?.user;
  const [scrolled, setScrolled] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 50);
    window.addEventListener('scroll', onScroll);
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  const navLinks = [
    { label: t.nav.home, href: '/' },
    { label: t.nav.about, href: '/about-us' },
    { label: t.nav.services, href: '/services' },
    { label: t.nav.articles, href: '/blog' },
    { label: t.nav.contact, href: '/contact' },
  ];

  return (
    <header
      className={`fixed top-0 inset-x-0 z-50 transition-all duration-300 ${scrolled ? 'bg-navy shadow-lg' : 'bg-transparent'
        }`}
    >
      <div className="container flex flex-col items-center pt-6 pb-2">
        {/* Logo centered */}
        <Link href="/" className="mb-5 flex flex-col items-center max-w-[85%]">
          {settings?.logo_url ? (
            <img src={settings.logo_url} alt={settings.site_name} className={`w-auto ${scrolled ? 'h-10' : 'h-17'}`} />
          ) : (
            <>
              {/* Show default icon but with site name text below it */}
              <img src={logo} alt="Logo" className={`w-auto max-w-[90%] mb-1 ${scrolled ? 'h-8' : 'h-12'}`} />
              <span className="text-white text-xl font-bold tracking-[0.05em]">{settings?.site_name || "أروقة النظام"}</span>
            </>
          )}
        </Link>

        {/* Desktop nav */}
        <nav className="hidden lg:flex items-center gap-8">
          {navLinks.map(link => {
            const isActive = link.href === '/' ? url === '/' : url.startsWith(link.href);
            return (
              <Link
                key={link.href}
                href={link.href}
                className={`transition-colors text-md ${isActive ? 'text-primary-foreground  font-bold' : 'text-primary-foreground/80 hover:text-primary-foreground font-light'}`}
              >
                {link.label}
              </Link>
            );
          })}
          <button
            onClick={toggleLanguage}
            className="text-primary-foreground/70 hover:text-primary-foreground text-sm font-semibold transition-colors"
          >
            {lang === 'ar' ? 'EN' : 'AR'}
          </button>
        </nav>

        {/* Mobile toggle */}
        <button
          className="lg:hidden absolute top-1/2 -translate-y-1/2 ltr:right-6 rtl:left-6 text-primary-foreground"
          onClick={() => setMobileOpen(!mobileOpen)}
        >
          {mobileOpen ? <X size={24} /> : <Menu size={24} />}
        </button>
      </div>

      {/* Mobile menu */}
      {mobileOpen && (
        <div className="lg:hidden bg-navy border-t border-primary-foreground/10">
          <nav className="container flex flex-col gap-4 py-6">
            {navLinks.map(link => {
              const isActive = link.href === '/' ? url === '/' : url.startsWith(link.href);
              return (
                <Link
                  key={link.href}
                  href={link.href}
                  onClick={() => setMobileOpen(false)}
                  className={`transition-colors flex ${isActive ? 'text-primary-foreground text-base font-bold' : 'text-primary-foreground/80 hover:text-primary-foreground text-base font-medium'}`}
                >
                  {link.label}
                </Link>
              );
            })}
            <button
              onClick={() => { toggleLanguage(); setMobileOpen(false); }}
              className="text-primary-foreground/70 text-sm font-semibold text-start"
            >
              {lang === 'ar' ? 'EN' : 'AR'}
            </button>
          </nav>
        </div>
      )}
    </header>
  );
};

export default Header;
