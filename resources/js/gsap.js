// animations
function heroComponentInit() {
    const heroSection = document.querySelector("#hero_section");

    // Eğer hero bölümü yoksa işleme devam etme
    if (!heroSection) {
        return;
    }

    // IntersectionObserver kullanımı
    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Animasyonlar yalnızca hero bölümü görünür olduğunda çalışacak
                    gsap.from("#designer", {
                        duration: 1,
                        x: -100,
                        opacity: 0,
                        ease: "back",
                    });
                    gsap.from("#developer", {
                        duration: 1,
                        x: 100,
                        opacity: 0,
                        ease: "back",
                    });
                    gsap.from("#designer_image", {
                        duration: 1,
                        y: -100,
                        opacity: 0,
                        ease: "back",
                    });
                    gsap.from("#developer_image", {
                        duration: 1,
                        y: 100,
                        opacity: 0,
                        ease: "back",
                    });

                    // hero titles only opacity animation
                    gsap.from("#hero_title_1", {
                        duration: 0.5,
                        opacity: 0,
                        delay: 0.2,
                    });
                    gsap.from("#hero_title_2", {
                        duration: 0.5,
                        opacity: 0,
                        delay: 0.5,
                    });

                    // Bir kez çalıştıktan sonra observer'ı devre dışı bırak
                    observer.disconnect();
                }
            });
        });

        // Hero bölgesini gözlemle
        observer.observe(heroSection);
    } else {
        // Eğer IntersectionObserver desteklenmiyorsa animasyonları hemen çalıştır
        gsap.from("#designer", {
            duration: 1,
            x: -100,
            opacity: 0,
            ease: "back",
        });
        gsap.from("#developer", {
            duration: 1,
            x: 100,
            opacity: 0,
            ease: "back",
        });
        gsap.from("#designer_image", {
            duration: 1,
            y: -100,
            opacity: 0,
            ease: "back",
        });
        gsap.from("#developer_image", {
            duration: 1,
            y: 100,
            opacity: 0,
            ease: "back",
        });

        gsap.from("#hero_title_1", { duration: 0.5, opacity: 0, delay: 0.2 });
        gsap.from("#hero_title_2", { duration: 0.5, opacity: 0, delay: 0.5 });
    }
}


function worksCardAnimateInit() {
    if (!document.querySelector("#works_card")) {
        return;
    }

    gsap.fromTo(
        "#works_card .grid > div",
        {
            opacity: 0,
            y: 100,
        },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            stagger: 0.2,
            scrollTrigger: {
                trigger: "#works_card .grid > div",
                start: "top 80%",
            },
        }
    );
}

function aboutComponentInit() {
    if (!document.querySelector("#about_section")) {
        return;
    }

    gsap.fromTo(
        "#about_section > div",
        {
            opacity: 0,
            y: 100,
        },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            stagger: 0.2,
            scrollTrigger: {
                trigger: "#about_section > div",
                start: "top 80%",
            },
        }
    );

    // images 3 different animations
    gsap.from("#about_image_1", {
        duration: 1,
        x: -100,
        opacity: 0,
        ease: "back",
        scrollTrigger: {
            trigger: "#about_image_1",
            start: "top 80%",
        },
    });

    gsap.from("#about_image_2", {
        duration: 1,
        x: 100,
        opacity: 0,
        ease: "back",
        scrollTrigger: {
            trigger: "#about_image_1",
            start: "top 80%",
        },
    });

    gsap.from("#about_image_3", {
        duration: 1,
        y: 100,
        opacity: 0,
        ease: "back",
        scrollTrigger: {
            trigger: "#about_image_1",
            start: "top 80%",
        },
    });
}

function blogComponentInit() {
    if (!document.querySelector("#blog_section")) {
        return;
    }

    gsap.fromTo(
        "#blog_post_0",
        {
            opacity: 0,
            y: 100,
        },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            scrollTrigger: {
                trigger: "#blog_post_0",
                start: "top 80%",
            },
        }
    );

    gsap.fromTo(
        "#blog_post_1, #blog_post_2, #blog_post_3",
        {
            opacity: 0,
            y: 200,
        },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            stagger: 0.2,
            scrollTrigger: {
                trigger: "#blog_post_1",
                start: "top 80%",
            },
        }
    );
}

function stepComponentInit() {
    if (!document.querySelector("#step_section")) {
        return;
    }

    const cards = gsap.utils.toArray(".stepCard");
    const spacer = 10;

    cards.forEach((card, index) => {
        ScrollTrigger.create({
            trigger: card,
            start: `top-=${index * spacer} top+=50px`,
            endTrigger: ".stepCards",
            end: `bottom top+=${200 + cards.length * spacer}`,
            pin: true,
            pinSpacing: false,
            markers: false,
            id: "card-pin",
            invalidateOnRefresh: true,
            onUpdate: (self) => {
                const scaleFactor = 1 - self.progress * 0.3;
                gsap.to(card, { scale: scaleFactor });
            },
        });
    });
}

function contactComponentInit() {
    if (!document.querySelector("#contactTitle")) {
        return;
    }

    gsap.fromTo(
        "#contactTitle",
        {
            opacity: 0,
            y: 100,
        },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            scrollTrigger: {
                trigger: "#contactTitle",
                start: "top 80%",
            },
        }
    );

    // contactForm every input and textarea and radio and checkbox and label
    gsap.fromTo(
        ".contactForm input, .contactForm textarea, .contactForm input[type='radio'], .contactForm input[type='checkbox'], .contactForm label, .contactForm h3, .contactForm span",
        {
            opacity: 0,
            y: 100,
        },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            stagger: 0.1,
            scrollTrigger: {
                trigger: ".contactForm",
                start: "top 80%",
            },
        }
    );
}

function blogPageCardsInit() {
    if (!document.querySelector("#blog_page_cards")) {
        return;
    }

    gsap.fromTo(
        "#blog_page_cards .grid > div",
        {
            opacity: 0,
            y: 100,
        },
        {
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.1,
            scrollTrigger: {
                trigger: "#blog_page_cards .grid > div",
                start: "top 80%",
            },
        }
    );
}

// init animations
document.addEventListener("livewire:navigated", () => {
    heroComponentInit();
    worksCardAnimateInit();
    aboutComponentInit();
    blogComponentInit();
    stepComponentInit();
    contactComponentInit();
    blogPageCardsInit();

    // Sayfa yüklendiğinde yatay kaydırmayı kapat
    disableHorizontalScroll();

    // Ekran boyutu değiştiğinde de yatay kaydırmayı kapat
    window.addEventListener("resize", disableHorizontalScroll);

    function disableHorizontalScroll() {
        if (window.innerWidth < 768) {
            document.body.style.overflowX = "hidden";
        } else {
            document.body.style.overflowX = "auto";
        }
    }
});