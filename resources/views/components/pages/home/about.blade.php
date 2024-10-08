<section id="about_section">
    <div class="container mt-32 md:mt-48">
        <div class="grid md:grid-cols-2 items-center gap-x-24">
            <div class="text-center md:text-left">
                <h1 class="text-3xl sm:text-5xl">{{ data_get($about, 'title') }}</h1>
                <article class="font-light mt-8 text-lg prose lg:prose-xl">
                    {!! data_get($about, 'content') !!}
                </article>
            </div>
            <div class="grid grid-cols-2 gap-x-4 mt-12 md:mt-0">
                <div class="content-center">
                    <img src="{{ Storage::url(data_get($about, 'images.0')) }}"
                        width="500" height="400"
                        id="about_image_1"
                        alt="{{ data_get($about, 'title') }}" 
                        class="object-cover rounded-3xl aspect-[4/3] md:aspect-[5/4] 2xl:aspect-[1/1] w-full"
                    >
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <img src="{{ Storage::url(data_get($about, 'images.1')) }}" alt="{{ data_get($about, 'title') }}" 
                            width="500" height="400"
                            id="about_image_2"
                            class="object-cover rounded-3xl aspect-[4/3] md:aspect-[5/4] 2xl:aspect-[1/1] w-full h-full">
                    </div>
                    <div>
                        <img src="{{ Storage::url(data_get($about, 'images.2')) }}" alt="{{ data_get($about, 'title') }}" 
                            width="500" height="400"
                            id="about_image_3"
                            class="object-cover rounded-3xl aspect-[4/3] md:aspect-[5/4] 2xl:aspect-[1/1] w-full h-full">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>