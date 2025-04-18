/** @type {import('tailwindcss').Config} */
import preset from "./vendor/filament/support/tailwind.config.preset";

import daisyui from "daisyui";

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./resources/**/*.blade.php",
    ],
    theme: {
        extend: {
            container: {
                center: true,
                padding: {
                    DEFAULT: "1rem",
                    sm: "2rem",
                    lg: "4rem",
                    xl: "5rem",
                    "2xl": "6rem",
                },
            },
            fontFamily: {
                sans: ["Gilroy", "sans-serif"],
            },
        },
    },
    daisyui: {
        themes: [
            {
                lofi: {
                    ...require("daisyui/src/theming/themes")["lofi"],
                },
            },
        ],
    },
    safelist: ["text-warning", "text-danger", "text-success", "text-info"],
    plugins: [require("@tailwindcss/typography"), daisyui],
};
