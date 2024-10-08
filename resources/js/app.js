import { gsap } from "gsap";

import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";
import { TextPlugin } from "gsap/TextPlugin";
import { EasePack } from "gsap/EasePack";

import Clipboard from "@ryangjchandler/alpine-clipboard"

import Prism from "prismjs";
import "prismjs/components/prism-markup-templating";
import "prismjs/components/prism-php";
import "prism-themes/themes/prism-coldark-dark.css";

document.addEventListener("livewire:navigated", () => {
    Prism.highlightAll();
});

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

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, TextPlugin, EasePack);

window.ScrollTrigger = ScrollTrigger;

window.gsap = gsap;

import "./gsap";

document.addEventListener("livewire:navigated", () => {
    const preloader = document.getElementById("preloader");

    if (preloader) {
        preloader.classList.add("hidden");
    }
});

document.addEventListener("contact-form:submitted", function () {
    offerForm.close();
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
