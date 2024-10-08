<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
        data-theme="ktlight"
        class="overflow-x-hidden scroll-smooth"
    >
    <head>
        @if (app()->environment('production'))
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-8JHJYRX80F"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-8JHJYRX80F');
        </script>
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

        <livewire:subscriber-form />

        <section class="container grid sm:flex justify-items-center sm:justify-between items-center mt-24 mb-8">
            <div class="flex justify-between sm:items-center items-center">
                <div class="stats">
                    <div class="stat text-xs">
                        <div class="stat-title">@lang('Ziyaretçi İstatistiği')</div>
                        <div class="text-[11px]">{{ Carbon\Carbon::parse('2024-10-03')->diffForHumans() }}'den beri sayılıyor</div>
                        <div class="stat-value text-2xl">
                            {{ App\Models\Setting::getValueByKey('total_views_count') }}
                        </div>
                    </div>
                </div>

                <div class="font-mono hover:cursor-pointer" id="cyberTheme">
                    <img src="/assets/img/cyberpunk.svg" alt="" class="w-32 h-auto" width="32" height="32">
                </div>
            </div>
            <div class="my-12 text-xs">
                <p class="text-right">
                    Designed & developed by <br> <a href="https://kaantanis.com" target="_blank" class="font-bold">Kaan Tanış</a>
                    <span class="tooltip tooltip-bottom hover:cursor-none" data-tip="Love yani aşk">&nbsp;with 🫶</span>
                </p>
            </div>
        </section>

        <x-modals />

        @stack('footer')
    </body>
</html>
