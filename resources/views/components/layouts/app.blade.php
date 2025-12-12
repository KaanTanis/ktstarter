@props([
    'page' => null,
    'hideLayout' => false,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
        data-theme="light"
        class="overflow-x-hidden scroll-smooth"
    >
    <!--[if ENDBLOCK]>cacto.art<![endif]-->    
    <head>
        @if (app()->environment('production'))
        <!-- Google tag (gtag.js) -->
        
        @endif

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />
        <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" type="image/png" />

        {!! SEO::generate() !!}
        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        
        @filamentStyles
        @livewireStyles
        @filamentScripts
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        @livewire('notifications')
    </head>
    
    <body class="!overflow-x-hidden antialiased">
        <x-preloader />

        @if (! $hideLayout)
            <x-layouts.navbar />
        @endif
        

        <main>
            {{ $slot }}
        </main>
        
        <x-modals />

        @if (! $hideLayout)
            <x-layouts.footer />
        @endif

        @livewireScriptConfig 
        @stack('footer')
    </body>
</html>
