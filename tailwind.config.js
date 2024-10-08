/** @type {import('tailwindcss').Config} */
import preset from "./vendor/filament/support/tailwind.config.preset";

import daisyui from "daisyui";
import { light, dark } from "daisyui/src/theming/themes";

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
                sans: ["Montserrat Alternates", "sans-serif"],
            },
        },
    },
    daisyui: {
        themes: [
            light,
            dark
        ],
    },
    safelist: ["text-warning", "text-danger", "text-success", "text-info"],
    plugins: [require("@tailwindcss/typography"), daisyui],
};
