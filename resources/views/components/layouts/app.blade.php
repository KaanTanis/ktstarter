<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
        data-theme="ktlight"
        class="overflow-x-hidden scroll-smooth"
    >
    <head>
        @if (app()->environment('production'))
        <!-- Google tag (gtag.js) -->
        
        @endif

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml" />

        {!! SEO::generate() !!}
        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="google-site-verification" content="G32AJZkQfctiXnbRQc-8bnEF-aXefwOr1Glxlv0BTN0" />

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @filamentScripts
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        @livewire('notifications')
    </head>
    
    <body class="!overflow-x-hidden">
        <x-preloader />
        <x-layouts.navbar />

        {{ $slot }}
        
        <x-modals />

        @stack('footer')
    </body>
</html>
