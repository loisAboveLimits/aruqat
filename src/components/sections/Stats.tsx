import { useLanguage } from '@/i18n/LanguageContext';
import { useEffect, useRef, useState } from 'react';
import { usePage } from '@inertiajs/react';

const useCountUp = (end: number, duration = 2000) => {
  const [count, setCount] = useState(0);
  const ref = useRef<HTMLDivElement>(null);
  const started = useRef(false);

  useEffect(() => {
    const el = ref.current;
    if (!el) return;
    const observer = new IntersectionObserver(([entry]) => {
      if (entry.isIntersecting && !started.current) {
        started.current = true;
        const startTime = performance.now();
        const animate = (now: number) => {
          const elapsed = now - startTime;
          const progress = Math.min(elapsed / duration, 1);
          setCount(Math.floor(progress * end));
          if (progress < 1) requestAnimationFrame(animate);
        };
        requestAnimationFrame(animate);
      }
    }, { threshold: 0.5 });
    observer.observe(el);
    return () => observer.disconnect();
  }, [end, duration]);

  return { count, ref };
};

const StatItem = ({ value, label }: { value: number, label: string }) => {
  const { count, ref } = useCountUp(value);
  return (
    <div ref={ref} className="flex flex-col items-center">
      <div className="md:text-start text-center">
        <div className="text-6xl md:text-8xl font-light text-foreground mb-2">
          +{count}
        </div>
        <p className="text-foreground font-light text-xl">{label}</p>
      </div>
    </div>
  );
};

interface StatsProps {
  stats?: any[];
}

const Stats = ({ stats: dynamicStats }: StatsProps) => {
  const { t, lang } = useLanguage();
  const { props } = usePage();
  const statsDataRaw = dynamicStats || (t as any).statsData || [];
  const isAdmin = (props.auth as any)?.user;

  // Format stats data
  const stats = statsDataRaw.map((s: any) => {
    let label = '';
    if (typeof s.title === 'string') {
      label = s.title;
    } else if (s.title && typeof s.title === 'object') {
      label = s.title[lang] || s.title['en'] || s.title['ar'] || '';
    }

    return {
      id: s.id,
      value: s.value,
      label: label,
    };
  });

  // Fallback if no dynamic stats and no static translations (unlikely but safe)
  const displayStats = stats.length > 0 ? stats : [
    { id: 'cases', value: 305, label: t.stats.cases },
    { id: 'experience', value: 35, label: t.stats.experience },
    { id: 'clients', value: 255, label: t.stats.clients },
  ];

  return (
    <section className="relative py-10 pb-20 bg-background group">
      <div className="container">
        <div className={`grid grid-cols-1 md:grid-cols-${Math.min(displayStats.length, 4)} gap-8`}>
          {displayStats.map((stat, i) => (
            <StatItem key={stat.id || i} value={stat.value} label={stat.label} />
          ))}
        </div>
      </div>
    </section>
  );
};

export default Stats;
