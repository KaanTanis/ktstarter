<div class="">
    {{-- build section  --}}
    <section class="container mt-12 md:mt-24">
        <div class="mockup-code bg-primary">
            @foreach ($work->code_field as $code_field)
            <pre data-prefix="{{ data_get($code_field, 'prefix') }}" class="{{ data_get($code_field, 'color_class') }}"><code>{{ data_get($code_field, 'code') }}</code></pre>
            @endforeach
        </div>
    </section>

    {{-- desktop mockup  --}}
    <section class="mt-12 md:mt-24 md:p-12 bg-base-200">
        <div class="container pt-12">
            <div class="mockup-browser border-base-300 border bg-base-100">
                <div class="mockup-browser-toolbar">
                    <div class="input border-base-300 border">{{ data_get($work, 'web_url') }}</div>
                </div>
                <div class="border-base-300 flex justify-center border-t">
                    <img src="{{ Storage::url(data_get($work, 'desktop_mockup')) }}" 
                        width="1600" height="900"
                        alt="{{ strip_tags($work->title) }}" 
                        class="w-full h-auto"
                    >
                </div>
            </div>
        </div>
    </section>
    
    <section class="container mt-24">
        <div class="flex flex-col md:flex-row justify-between gap-12">
            {{-- mobile mockup  --}}
            <div class="order-2 md:order-1 w-full md:w-1/2 lg:w-1/3">
                <div class="mockup-phone">
                    <div class="camera"></div>
                    <div class="display">
                        <div class="artboard artboard-demo phone-1 !h-full !w-full">
                            <img src="{{ Storage::url(data_get($work, 'mobile_mockup')) }}" 
                                width="375" height="812"
                                alt="{{ strip_tags($work->title) }}" 
                                class="w-full h-auto"
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-1 md:order-2 w-full md:w-1/2 lg:w-2/3">
                <article class="prose !max-w-none">
                    {!! data_get($work, 'body') !!}
                </article>

                <div class="mt-12 [&_h3]:font-bold">
                    <h2 class="font-bold text-2xl">
                        @lang('Proje Detayları')
                    </h2>
                    @foreach ($work->properties as $property)
                    <div class="flex gap-x-4 mt-4">
                        <h3>{{ data_get($property, 'key') }}</h3>
                        <p>{{ data_get($property, 'value') }}</p>
                    </div>
                    @endforeach
                    @if (data_get($work, 'web_url'))
                    <a href="{{ data_get($work, 'web_url') }}" target="_blank" class="btn btn-sm mt-4">
                        @lang('Projeyi Görüntüle')
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>


    <section class="container mt-24">
        <div class="flex justify-between">
            @if ($previousWork)
                <a href="@route('work', $previousWork->slug)" wire:navigate class="flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                    </svg>
                    <span class="hidden sm:block">
                        {{ strip_tags($previousWork->title) }}
                    </span>
                    <span class="block sm:hidden">
                        @lang('Önceki Proje')
                    </span>
                </a>
                @else
                <div></div>
            @endif

            @if ($nextWork)
                <a href="@route('work', $nextWork->slug)" wire:navigate class="flex items-center gap-x-2">
                    <span class="hidden sm:block">
                        {{ strip_tags($nextWork->title) }}
                    </span>
                    <span class="block sm:hidden">
                        @lang('Sonraki Proje')
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            @endif
        </div>
    </section>


</div>
