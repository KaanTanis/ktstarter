<section id="blog_section">
    <div class="container mt-48">
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold">
                @lang('İşin Tekniği')
            </h1>
            <a wire:navigate href="@route('blogs')" class="text-sm btn btn-primary">
                @lang('Bütün Yazılar')
            </a>
        </div>

        @php
            $firstPost = $posts->first();

            $posts = $posts->skip(1);
        @endphp
        
        <div class="grid md:flex gap-x-6 gap-y-6">
            <div class="w-full md:w-1/3 relative" id="blog_post_0">
                <a href="{{ $firstPost->url }}" wire:navigate>
                    <div class="absolute inset-0 bg-primary/30 rounded-3xl"></div>
                    <img class="aspect-square rounded-3xl h-full w-full object-cover" 
                        width="600" height="400"
                        src="{{ Storage::url($firstPost->cover) }}" 
                        alt="{{ $firstPost->title }}"
                    >
                </a>
                <span class="absolute top-4 right-4 bg-neutral text-base-100 rounded-full px-4 py-2 text-xs">
                    {{ $firstPost->created_at->format('j M Y') }}
                </span>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center w-full grid gap-y-2 text-base-100">
                    <a href="@route('blogs', ['selectedTag' => $firstPost->tags()->first()->slug])" wire:navigate>
                        {{ $firstPost->tags->first()->name }}
                    </a>
                    <h1 class="font-bold">
                        <a href="{{ $firstPost->url }}" wire:navigate>{{ $firstPost->title }}</a>
                    </h1>
                </div>
            </div>
            <div class="w-full md:w-2/3 flex flex-col justify-between gap-y-6">
                @foreach ($posts as $post)
                <div class="flex items-center" id="blog_post_{{ $loop->iteration }}">
                    <div class="w-1/4">
                        <a href="{{ $post->url }}" wire:navigate>
                            <img class="aspect-square rounded-3xl object-cover w-full h-full" 
                                width="250" height="250"
                                src="{{ Storage::url($post->cover) }}" 
                                alt="{{ $post->title }}"
                            >
                        </a>
                    </div>
                    <div class="w-3/4 pl-4 flex flex-col space-y-2">
                        <div class="gap-x-2 hidden sm:flex">
                        @foreach ($post->tags as $tag)
                            <a href="@route('blogs', ['selectedTag' => $tag->slug])" class="text-xs badge badge-primary badge-outline badge-l" wire:navigate>
                                {{ $tag->name }}
                            </a>
                        @endforeach
                        </div>
                        <h1>
                            <a href="{{ $post->url }}" wire:navigate class="font-bold text-md sm:text-lg">
                                {{ $post->title }}
                            </a>
                        </h1>
                        <span class="text-xs font-light">
                            {{ $post->created_at->format('j M Y') }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</section>