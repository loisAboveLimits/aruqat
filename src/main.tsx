import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { Toaster as Sonner } from "@/components/ui/sonner";
import { Toaster } from "@/components/ui/toaster";
import { TooltipProvider } from "@/components/ui/tooltip";
import { LanguageProvider } from "@/i18n/LanguageContext";
import "./index.css";

const queryClient = new QueryClient();

createInertiaApp({
  title: (title) => title,
  resolve: async (name) => {
    const pages = import.meta.glob("./pages/**/*.tsx");
    const page = (await pages[`./pages/${name}.tsx`]()) as any;
    const PageComponent = page.default;

    // Wrap page in providers to ensure they have access to Inertia context
    PageComponent.layout = PageComponent.layout || ((page: any) => (
      <QueryClientProvider client={queryClient}>
        <LanguageProvider>
          <TooltipProvider>
            <Toaster />
            <Sonner />
            {page}
          </TooltipProvider>
        </LanguageProvider>
      </QueryClientProvider>
    ));

    return PageComponent;
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />);
  },
});
