import { Link, usePage, Head } from '@inertiajs/react';
import { useLanguage } from '@/i18n/LanguageContext';
import Header from '@/components/sections/Header';
import CTASection from '@/components/sections/CTASection';
import heroBg from '@/assets/hero_bg.png';
import article1 from '@/assets/article-1.jpg';
import article2 from '@/assets/article-2.jpg';
import article3 from '@/assets/article-3.jpg';
import title_vector from '@/assets/title_vector.svg';
import hero_overlay from '@/assets/hero_overlay.png';

const articleImages = [article1, article2, article3];

const BlogDetail = () => {
  const { t, lang, isRTL, localize } = useLanguage() as any;
  const { props } = usePage();
  const post = props.post as any;
  const relatedPosts = (props.relatedPosts as any[]) || [];

  if (!post) {
    return (
      <div className="min-h-screen flex flex-col items-center justify-center">
        <h1 className="text-2xl font-bold">Article not found</h1>
        <Link href="/blog" className="mt-4 text-primary underline">Back to Blog</Link>
      </div>
    );
  }

  const title = localize(post.title);
  const content = localize(post.content);
  const imageUrl = post.cover_url || heroBg;

  return (
    <div className="min-h-screen">
      <Head title={title} />
      <Header />

      {/* Hero */}
      <section className="relative h-[400px] md:h-[500px] min-h-screen flex items-center justify-center">
        <div className="absolute inset-0 bg-cover bg-center" style={{ backgroundImage: `url(${imageUrl})` }} />
        <div className="absolute inset-0" style={{ backgroundImage: `url(${hero_overlay})`, backgroundSize: "cover", backgroundPosition: "center" }} />
        <div className="relative z-10 text-center container px-4">
          <h1 className="text-3xl md:text-6xl font-bold text-white tracking-wide max-w-4xl mx-auto animate-fade-in-up" style={{ lineHeight: '1.625' }}>
            {title}
          </h1>
        </div>
      </section>

      {/* Content Section */}
      <section className="py-16 md:py-24 bg-background">
        <div className="container">
          <div
            className="prose prose-lg max-w-none text-muted-foreground leading-relaxed whitespace-pre-line"
            dangerouslySetInnerHTML={{ __html: content }}
          />
        </div>
      </section>

      {/* Other Articles Section */}
      <section className="py-16 md:py-24 bg-background border-t border-border/50">
        <div className="container px-4">
          <div className="flex items-center gap-3 mb-12">
            <img src={title_vector} alt="" className="w-12 h-12" />
            <h2 className="text-2xl md:text-3xl font-bold text-foreground">
              {t.articles.otherArticles}
            </h2>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {relatedPosts.map((item, i) => {
              const itemTitle = localize(item.title);
              const itemImage = item.cover_url || articleImages[i % articleImages.length];
              const itemId = item.slug || item.id;

              return (
                <Link
                  href={`/blog/${itemId}`}
                  key={item.id}
                  className="bg-card bg-transparent rounded-3xl overflow-hidden border border-[#575757] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg h-full flex flex-col"
                >
                  <div className="p-5 pb-0">
                    <img
                      src={itemImage}
                      alt={itemTitle}
                      className="w-full h-[250px] object-cover rounded-3xl"
                      loading="lazy"
                    />
                  </div>
                  <div className="p-6 flex flex-col flex-grow">
                    <h3 className="text-muted-foreground font-bold text-2xl mb-20 leading-relaxed">
                      {itemTitle}
                    </h3>
                    <div className="text-sm font-bold text-foreground underline underline-offset-4 mt-auto">
                      {t.articles.readMore}
                    </div>
                  </div>
                </Link>
              );
            })}
          </div>
        </div>
      </section>

      <CTASection />
    </div>
  );
};

export default BlogDetail;
