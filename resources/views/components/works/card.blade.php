<div class="grid md:flex items-center justify-items-center">
    <div class="w-full md:w-[60%] relative md:left-6">
        <img src="{{ Storage::url(data_get($work, 'cover')) }}" alt="{{ strip_tags($work->title) }}" 
            width="500" height="400"
            class="object-cover rounded-3xl aspect-[4/3] md:aspect-[5/4] w-full"
        >
    </div>

    <div class="w-[80%] md:w-[40%] z-10 relative md:right-6 -top-12 md:top-0">
        <div class="bg-base-content text-base-100 w-full h-full aspect-[4/3] md:aspect-[5/4] rounded-3xl p-6">
            <h1 class="text-3xl lg:text-4xl xl:text-6xl 2xl:text-7xl leading-none top-6 sm:top-12 absolute">
                {!! data_get($work, 'title') !!}
            </h1>
            <div class="grid grid-cols-3 absolute bottom-8">
                <div class="col-span-1 self-center">
                    <span class="transform -rotate-90 inline-block text-xs lg:text-base relative -top-1 -left-10 text-nowrap w-full xl:-top-4 xl:-left-12 2xl:-top-12 2xl:-left-16">
                        {{ App\Enums\WorkEnums::tryFrom($work->type)->getLabel() }}
                    </span>
                </div>
                <div class="col-span-2 pr-4">
                    <p class="text-xs lg:text-base 2xl:text-lg">
                        {{ data_get($work, 'summary') }}
                    </p>
                    <a wire:navigate href="@route('work', $work->slug)" class="mt-2 text-xs flex items-center gap-x-2 font-bold lg:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                        @lang('İncele')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>