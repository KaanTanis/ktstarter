@props([
    'title' => null,
    'subtitle' => null,
    'ctaLabel' => __('Hemen Başla'),
    'ctaUrl' => '#contact',
])

<section class="bg-base-200 border-b border-base-300">
    <div class="container py-12 lg:py-16 grid gap-6 lg:grid-cols-2 items-center">
        <div class="space-y-4">
            <p class="badge badge-primary badge-lg">@lang('Starter Kit')</p>
            <h1 class="text-3xl lg:text-4xl font-extrabold leading-tight">
                {{ $title ?? config('app.name') }}
            </h1>
            <p class="text-base text-base-content/70">
                {{ $subtitle ?? __('Laravel + Filament + Livewire ile üretime hazır bir başlangıç kiti.') }}
            </p>

            <div class="flex items-center gap-3">
                <a href="{{ $ctaUrl }}" class="btn btn-primary">{{ $ctaLabel }}</a>
                <a href="#features" class="btn btn-ghost">@lang('Özellikler')</a>
            </div>
        </div>

        <div class="rounded-2xl bg-base-100 shadow-xl border border-base-300 p-6">
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <p class="text-xs text-base-content/60">@lang('SEO ve meta')</p>
                    <p class="font-semibold">Artesaos SEOTools</p>
                </div>
                <div>
                    <p class="text-xs text-base-content/60">@lang('Panel')</p>
                    <p class="font-semibold">Filament v4</p>
                </div>
                <div>
                    <p class="text-xs text-base-content/60">@lang('İstatistik')</p>
                    <p class="font-semibold">Eloquent Viewable</p>
                </div>
                <div>
                    <p class="text-xs text-base-content/60">@lang('Önbellek')</p>
                    <p class="font-semibold">@lang('Hazır cache katmanı')</p>
                </div>
            </div>
        </div>
    </div>
</section>
