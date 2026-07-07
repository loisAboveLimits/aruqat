import title_vector from '@/assets/title_vector.svg';
import { Link } from '@inertiajs/react';

interface SectionHeaderProps {
  badge: string;
  linkText?: string;
  linkHref?: string;
}

const SectionHeader: React.FC<SectionHeaderProps> = ({ badge, linkText, linkHref = '#' }) => {
  return (
    <div className="flex items-center justify-between mb-4 flex-col md:flex-row gap-4">
      <div className="flex items-center gap-3">
        <img src={title_vector} alt="title_vector" className="w-8 h-8 md:w-12 md:h-12" />
        <h2 className="text-xl md:text-3xl font-medium text-foreground">{badge}</h2>
      </div>
      {linkText && (
        <Link href={linkHref} className="text-sm font-bold text-foreground underline underline-offset-4 hover:text-navy-light transition-colors">
          {linkText}
        </Link>
      )}
    </div>
  );
};

export default SectionHeader;
