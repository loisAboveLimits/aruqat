<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        

        @php
            $settings = $page['props']['settings'] ?? null;
            $locale = app()->getLocale();
            $siteName = $settings['site_name'][$locale] ?? $settings['site_name']['ar'] ?? config('app.name', 'Arwqat Al Netham');
            $favicon = $settings['favicon_url'] ?? asset('favicon.ico');
            $favType = str_ends_with($favicon, '.svg') ? 'image/svg+xml' : 'image/x-icon';
        @endphp


        <!-- <title inertia>{{ $siteName }}</title> -->

        <link rel="icon" type="{{ $favType }}" href="{{ $favicon }}">

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['src/main.tsx'])
        @inertiaHead

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script src="https://kit.fontawesome.com/d3da0053ba.js" crossorigin="anonymous"></script>
    </body>
</html>
