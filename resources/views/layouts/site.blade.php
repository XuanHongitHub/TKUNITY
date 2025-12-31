<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', setting('seo_title', setting('site_name', 'TKUnity')))</title>
    <meta name="description" content="@yield('meta_description', setting('seo_description', setting('site_description', '')))">
    <meta name="theme-color" content="{{ setting('theme_color', '#0f0f0f') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @if (setting('favicon'))
        <link rel="icon" href="{{ Storage::url(setting('favicon')) }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @settings('google_tags')
    @if (setting('google_verify'))
        <meta name="google-site-verification" content="{{ setting('google_verify') }}">
    @endif
    @yield('styles')
    @yield('head')
    @livewireStyles
    @settings('site_head')
</head>
<body class="@yield('body_class')">
    <x-site-header variant="@yield('nav_variant', 'default')" />

    @yield('content')

    <x-site-footer />

    @livewireScripts
    @yield('scripts')
    @settings('tiktok_pixel')
    @settings('site_footer')
</body>
</html>
