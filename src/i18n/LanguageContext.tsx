import React, { createContext, useContext, useState, useCallback, useEffect, useMemo } from 'react';
import { usePage } from '@inertiajs/react';
import ar from './ar.json';
import en from './en.json';

type Language = 'ar' | 'en';

interface LanguageContextType {
  lang: Language;
  t: typeof ar;
  toggleLanguage: () => void;
  isRTL: boolean;
  settings: any;
  localize: (data: any, fallback?: any) => any;
}

const staticTranslations = { ar, en };

const LanguageContext = createContext<LanguageContextType | null>(null);

export const LanguageProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [lang, setLang] = useState<Language>(() => {
    if (typeof window !== 'undefined') {
      const savedLang = localStorage.getItem('app_lang') as Language;
      if (savedLang === 'ar' || savedLang === 'en') {
        return savedLang;
      }
    }
    return 'ar';
  });
  const { props } = usePage();

  const toggleLanguage = useCallback(() => {
    setLang(prev => {
      const newLang = prev === 'ar' ? 'en' : 'ar';
      if (typeof window !== 'undefined') {
        localStorage.setItem('app_lang', newLang);
      }
      return newLang;
    });
  }, []);

  const isRTL = lang === 'ar';

  useEffect(() => {
    document.documentElement.dir = isRTL ? 'rtl' : 'ltr';
    document.documentElement.lang = lang;
  }, [lang, isRTL]);

  const t = useMemo(() => {
    const currentStatic = staticTranslations[lang];
    
    // Helper to safely extract localized data from potentially mixed data types
    const getLocalized = <T,>(data: any, fallback: T): T => {
        if (!data) return fallback;
        if (typeof data === 'string' || Array.isArray(data)) return data as unknown as T;
        if (typeof data === 'object') {
            return (data[lang] || data['ar'] || data['en'] || fallback) as T;
        }
        return fallback;
    };

    // Deep merge or overwrite specific sections with dynamic data if they exist in props
    const dynamicData: any = { ...currentStatic };

    if (props.hero) {
        dynamicData.heroData = props.hero;
        const h = props.hero as any;
        dynamicData.hero = {
            ...dynamicData.hero,
            title: getLocalized(h.title, dynamicData.hero.title),
            cta: getLocalized(h.cta_label, dynamicData.hero.cta),
            secondary: getLocalized(h.secondary_cta_label, dynamicData.hero.secondary),
        };
    }

    if (props.about) {
        dynamicData.aboutData = props.about;
        const a = props.about as any;
        dynamicData.about = {
            ...dynamicData.about,
            badge: getLocalized(a.badge, dynamicData.about.badge),
            description1: getLocalized(a.description, dynamicData.about.description1),
            cta: getLocalized(a.cta_label, dynamicData.about.cta),
        };
    }

    if (props.goal) {
        dynamicData.goalData = props.goal;
        const g = props.goal as any;
        dynamicData.vision = {
            ...dynamicData.vision,
            badge: getLocalized(g.badge, dynamicData.vision.badge),
            title: getLocalized(g.title, dynamicData.vision.title),
            cta: getLocalized(g.cta_label, dynamicData.vision.cta),
        };
    }
    
    // Map stats
    if (props.stats) {
        dynamicData.statsData = props.stats; // Custom key to avoid conflict with labels
    }

    // Map services, team, articles
    if (props.services) dynamicData.dynamicServices = props.services;
    if (props.team) dynamicData.dynamicTeam = props.team;
    if (props.articles) dynamicData.dynamicArticles = props.articles;
    if (props.clientLogos) dynamicData.dynamicClientLogos = props.clientLogos;

    if (props.settings) {
        const s = props.settings as any;
        dynamicData.settings = {
            ...s,
            site_name: getLocalized(s.site_name, 'أروقة النظام'),
            address: getLocalized(s.address, ''),
            footer: {
                ...s.footer,
                description: getLocalized(s.footer?.description, ''),
                copyright: getLocalized(s.footer?.copyright, ''),
                tqnia_copyright: getLocalized(s.footer?.tqnia_copyright, ''),
                nav: (() => {
                    const navArray = getLocalized(s.footer?.nav, []);
                    return Array.isArray(navArray) ? navArray.map((item: any) => ({
                        ...item,
                        label: getLocalized(item.label, '')
                    })) : [];
                })()
            }
        };
    }

    return dynamicData;
  }, [lang, props]);

  const localize = useCallback((data: any, fallback: any = '') => {
    if (!data) return fallback;
    if (typeof data === 'string' || Array.isArray(data)) return data;
    if (typeof data === 'object') {
        return data[lang] || data['ar'] || data['en'] || Object.values(data)[0] || fallback;
    }
    return fallback;
  }, [lang]);

  // Remove manual document.title update to let Inertia Head handle it
  /*
  useEffect(() => {
    if (t?.settings?.site_name) {
      document.title = t.settings.site_name;
    }
  }, [t?.settings?.site_name]);
  */

  return (
    <LanguageContext.Provider value={{ lang, t, toggleLanguage, isRTL, settings: t.settings, localize }}>
      {children}
    </LanguageContext.Provider>
  );
};

export const useLanguage = () => {
  const ctx = useContext(LanguageContext);
  if (!ctx) throw new Error('useLanguage must be used within LanguageProvider');
  return ctx;
};
