import { usePage, Head } from '@inertiajs/react';
import Header from '@/components/sections/Header';
import CTASection from '@/components/sections/CTASection';
import { useLanguage } from '@/i18n/LanguageContext';
import { Link } from '@inertiajs/react';
import heroBg from '@/assets/hero_bg.png';
import article1 from '@/assets/article-1.jpg';
import article2 from '@/assets/article-2.jpg';
import article3 from '@/assets/article-3.jpg';
import hero_overlay from '@/assets/hero_overlay.png';

const articleImages = [article1, article2, article3];

const BlogPage = () => {
  const { t, lang, settings, localize } = useLanguage() as any;
  const { props } = usePage();
  const posts = (props.posts as any)?.data || [];
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

      {/* Hero */}
      <section className="relative h-[400px] md:h-[500px] min-h-screen flex items-center justify-center">
        <div className="absolute inset-0 bg-cover bg-center" style={{ backgroundImage: `url(${settings?.blog_hero_url || heroBg})` }} />
        <div className="absolute inset-0" style={{ backgroundImage: `url(${hero_overlay})`, backgroundSize: "cover", backgroundPosition: "center" }} />
        <div className="relative z-10 text-center">
          <h1 className="text-4xl md:text-6xl font-bold text-white tracking-wide animate-fade-in-up">
            {t.articles.title}
          </h1>
        </div>
      </section>

      {/* Articles Grid */}
      <section className="py-16 md:py-24 bg-background">
        <div className="container max-w-6xl">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {posts.length > 0 ? posts.map((post: any, i: number) => {
              const title = localize(post.title);
              const imageUrl = post.cover_url || articleImages[i % articleImages.length];
              const postId = post.slug || post.id;

              return (
                <article key={i} className="bg-card bg-transparent rounded-3xl overflow-hidden border border-[#575757] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg h-full flex flex-col">
                  <Link href={`/blog/${postId}`} className="flex flex-col h-full">
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
                      <div className="text-sm font-bold text-foreground underline underline-offset-4 transition-colors mt-auto">
                        {t.articles.readMore}
                      </div>
                    </div>
                  </Link>
                </article>
              );
            }) : (
              <div className="col-span-full text-center py-20">
                <p className="text-muted-foreground text-xl">No posts found.</p>
              </div>
            )}
          </div>
        </div>
      </section>

      <CTASection />
    </div>
  );
};

export default BlogPage;
