<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/favicons/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('images/favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('images/favicons/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">  

        @php
            $settings = $page['props']['settings'] ?? null;
            $locale = app()->getLocale();
            $siteName = $settings['site_name'][$locale] ?? $settings['site_name']['ar'] ?? config('app.name', 'Arwqat Al Netham');
            $favicon = $settings['favicon_url'] ?? asset('favicon.ico');
            $favType = str_ends_with($favicon, '.svg') ? 'image/svg+xml' : 'image/x-icon';
        @endphp


        <title inertia></title> 

        <!-- <link rel="icon" type="{{ $favType }}" href="{{ $favicon }}"> -->



        <!-- Scripts -->
        @viteReactRefresh
        @vite(['src/main.tsx'])
        @inertiaHead

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        @if (config('services.google_analytics.id'))
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.id') }}"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '{{ config('services.google_analytics.id') }}');
        </script>
        @endif     
        
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script src="https://kit.fontawesome.com/d3da0053ba.js" crossorigin="anonymous"></script>
    </body>
</html>
