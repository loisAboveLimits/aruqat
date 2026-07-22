import { Head } from '@inertiajs/react';
import Header from '@/components/sections/Header';
import { useLanguage } from '@/i18n/LanguageContext';
import Hero from '@/components/sections/Hero';
import About from '@/components/sections/About';
import Stats from '@/components/sections/Stats';
import ClientLogos from '@/components/sections/ClientLogos';
import Vision from '@/components/sections/Vision';
import Services from '@/components/sections/Services';
import Team from '@/components/sections/Team';
import Articles from '@/components/sections/Articles';
import CTASection from '@/components/sections/CTASection';



const Index = (props: any) => {
  const { t } = useLanguage();
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
      <Hero {...props.hero} />
      <About {...props.about} />
      <Stats stats={props.stats} />
      <ClientLogos dynamicClientLogos={props.clientLogos} />
      <Vision {...props.goal} />
      <Services dynamicServices={props.services} />
      <Team dynamicTeam={props.team} />
      <Articles dynamicArticles={props.articles} />
      <CTASection />
    </div>
  );
};

export default Index;
