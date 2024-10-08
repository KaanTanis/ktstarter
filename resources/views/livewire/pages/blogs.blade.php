<div class="">
    @php
        $banner = [
            'breadcrumb' => [
                [
                    'title' => trans('Ana Sayfa'),
                    'url' => route('home')
                ],
                [
                    'title' => trans('Bloglar'),
                    'url' => null
                ],
            ],
            'title' => trans('Blog İçerikleri')
        ];
    @endphp

    <x-banner :$banner />

    <section class="container mt-16" id="blog_page_cards">
        <div class="flex flex-wrap gap-3">
            @foreach ($tags as $tag)
                <button @class([
                    'btn btn-primary btn-sm',
                    'bg-primary-content text-primary hover:bg-primary-content' => $selectedTag == $tag->slug
                ]) wire:click="selectTag('{{ $tag->slug }}')">
                    {{ $tag->name }}
                </button>
            @endforeach
        </div>
        
        <div class="mb-8 grid sm:flex gap-y-4 justify-between items-center mt-8">
            <div class="dropdown z-10">
                <div tabindex="0" role="button" class="btn m-1 btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    {{ $this->orderTypes()[$orderBy] }}
                </div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-10 w-52 p-2 shadow space-y-2">
                    @foreach ($this->orderTypes() as $type => $name)
                        <li wire:click="order('{{ $type }}')">
                            <a @class([
                                'bg-base-300' => $orderBy === $type
                            ])>
                                {{ $name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <label class="input input-bordered flex items-center gap-2">
                    <input wire:model.live.debounce.500ms='search' type="text" class="grow input border-none" placeholder="@lang('Ara')" />
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 16 16"
                        fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path
                        fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                    </svg>
                </label>
            </div>
        </div>

        @forelse ($posts as $post)
            <div class="grid grid-cols-5 items-center gap-x-12 mb-12 gap-y-6 p-4">
                <div class="sm:col-span-2 col-span-5 relative">
                    <a href="{{ $post->url }}" wire:navigate>
                        <img class="aspect-[4/3] w-full rounded-3xl object-cover" src="{{ Storage::url($post->cover) }}" 
                            width="600" height="400"
                            alt="{{ $post->title }}"
                        >
                    </a>

                    <div class="flex gap-x-2 absolute top-4 right-4">
                        @foreach ($post->tags as $tag)
                        <a href="@route('blogs', ['selectedTag' => $tag->slug])" wire:navigate class="text-xs badge badge-primary badge-lg">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="sm:col-span-3 col-span-5 grid gap-y-4 p-2">
                    <h1 class="sm:text-2xl text-lg font-bold">
                        <a href="{{ $post->url }}" wire:navigate>{{ $post->title }}</a>
                    </h1>
                    <article>
                        {{ $post->summary() }}
                    </article>
                    <span class="block text-xs">
                        {{ $post->published_at->diffForHumans() }}
                    </a>
                </div>
            </div>
            @empty
            <hr>
            <div class="text-center mt-8">
                <p>@lang('Aramalarınıza uygun blog yazısı bulunamadı')</p>

                <button class="btn btn-primary mt-4" wire:click='resetFilter'>@lang('Filtreleri Sıfırla')</button>
            </div>
        @endforelse

        @if ($loadMoreButton)
        <div class="flex justify-center">
            <button class="btn btn-primary" wire:click='loadMore'>
                <span wire:loading>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 animate-spin">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </span>
                @lang('Daha Fazla Göster')
            </button>
        </div>
        @endif
    </section>
</div>
