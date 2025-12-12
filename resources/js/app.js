import { gsap } from "gsap";

import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";
import { TextPlugin } from "gsap/TextPlugin";
import { EasePack } from "gsap/EasePack";

import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";

import Clipboard from "@ryangjchandler/alpine-clipboard"

// import Prism from "prismjs";
// import "prismjs/components/prism-markup-templating";
// import "prismjs/components/prism-php";
// import "prism-themes/themes/prism-coldark-dark.css";

// document.addEventListener("livewire:navigated", () => {
//     Prism.highlightAll();
// });

Alpine.plugin(
    Clipboard.configure({
        onCopy: () => {
            new FilamentNotification()
                .title("Kopyalandı")
                .icon("heroicon-o-document-text")
                .color("success")
                .send();
        },
    })
);

Livewire.start();

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, TextPlugin, EasePack);

window.ScrollTrigger = ScrollTrigger;

window.gsap = gsap;

import "./gsap";

// splide
import "@splidejs/splide/css/core";

import Splide from "@splidejs/splide";

window.Splide = Splide;

document.addEventListener("livewire:navigated", () => {
    const preloader = document.getElementById("preloader");

    if (preloader) {
        preloader.classList.add("hidden");
    }
});

document.addEventListener("livewire:navigated", function () {
    let acceptCookieBtn = document.getElementById("acceptCookie");

    if (acceptCookieBtn) {
        acceptCookieBtn.addEventListener("click", acceptCookie);
    }

    function acceptCookie() {
        localStorage.setItem("acceptCookie", true);
        document.getElementById("cookieConsent").classList.add("hidden");
    }
    
    if (!localStorage.getItem("acceptCookie")) {
        document.getElementById("cookieConsent").classList.remove("hidden");
    }
})

import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

Fancybox.bind("[data-fancybox]", {
    // Your custom options
});