<div>
    <section class="hero min-h-screen" id="aboutHero">
        <div class="hero-content text-center">
            <div>
                <h1 class="text-7xl relative -top-20 text-center sm:hidden font-bold">
                    <span class="mr-24" id="hero_title_1">Kaan</span> <br>
                    <span class="ml-24" id="hero_title_2">Tanış</span>
                </h1>
                <h1 class="sm:text-5xl text-wrap" id="me">
                    {{ data_get($page, 'data.hero.title') }}
                </h1>
                <div class="mt-12">
                    <div class="sm:text-8xl text-2xl font-bold font-mono flex gap-x-24 justify-center">
                        <p id="list"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="hero min-h-screen" id="about">
        <div class="hero-content text-center">
            <article class="prose">
                {!! data_get($page, 'data.content') !!}
            </article>
        </div>
    </section>

    <section class="hero min-h-screen mb-96" id="techs">
        <div class="hero-content text-center">
            <article class="relative overflow-hidden">
                <h1 class="text-3xl font-bold pb-24">
                    {{ data_get($page, 'data.technologies.title') }}
                </h1>

                <div class="flex flex-wrap justify-center gap-x-8 mt-8" id="techImg">
                    @foreach (data_get($page, 'data.technologies.technologies') as $technology)
                        <img class="object-contain h-16 w-auto opacity-0"
                            width="100" height="100"
                            src="{{ Storage::url(data_get($technology, 'logo')) }}" 
                            alt="{{ data_get($technology, 'title') }}" 
                        >
                    @endforeach
                </div>
            </article>
        </div>
    </section>


    <script>
        document.addEventListener("livewire:navigated", () => {
            if (!document.getElementById('list')) {
                return;
            }

            gsap.from("#hero_title_1", { duration: 0.5, opacity: 0, delay: 0.2 });
            gsap.from("#hero_title_2", { duration: 0.5, opacity: 0, delay: 0.5 });

            const titles = @json(data_get($page, 'data.hero.titles'));
            const listElement = document.getElementById('list');

            let index = 0;

            function changeTitle() {
                // Fade out the current title
                gsap.to(listElement, { duration: 0.3, opacity: 0, onComplete: () => {
                    // Update the text content
                    listElement.textContent = titles[index]['title'];
                    // Fade in the new title
                    gsap.to(listElement, { duration: 0.3, opacity: 1 });
                }});

                // Update the index for the next title
                index = (index + 1) % titles.length;

                // Set the timeout to change the title every 1 second (adjust as needed)
                setTimeout(changeTitle, 800); // Change this to control the speed
            }

            // Start the title changing loop
            changeTitle();
        }, {once: true});

        document.addEventListener('livewire:navigated', () => {
            const techImg = document.getElementById('techImg');
            if (!techImg) {
                return;
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Animate the whole container first
                        gsap.fromTo(techImg, { opacity: 0 }, { duration: 0.5, opacity: 1, delay: 0.2 });

                        const techsImages = techImg.children;
                        for (let i = 0; i < techsImages.length; i++) {
                            gsap.fromTo(techsImages[i], { opacity: 0 }, { duration: 0.5, opacity: 1, delay: 0.2 + i * 0.1 });
                        }

                        observer.unobserve(techImg);
                    }
                });
            }, {
                threshold: 0.1
            });

            observer.observe(techImg);
        }, { once: true });

        document.addEventListener('livewire:navigated', () => {
            const sections = ["#aboutHero", "#about", "#techs"];
            
            sections.forEach(section => {
                ScrollTrigger.create({
                    trigger: section,
                    pin: true,
                    start: "top top",
                    end: () => "+=" + window.innerHeight / 3,
                    scrub: 0.5,
                    pinSpacing: false
                });
            });
        }, { once: true });
    </script>
</div>
