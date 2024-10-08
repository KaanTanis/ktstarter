/** @type {import('tailwindcss').Config} */
import preset from "./vendor/filament/support/tailwind.config.preset";

import daisyui from "daisyui";
import { cyberpunk } from "daisyui/src/theming/themes";

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
            {
                ktdark: {
                    "base-100": "#000000",
                    "base-200": "#1D232A",
                    "base-300": "#323a42",
                    "base-content": "#fff",
                    primary: "#283340",
                    accent: "#ffffff",
                    "accent-content": "#000000",
                    secondary: "#1D232A",
                },
                ktlight: {
                    ...require("daisyui/src/theming/themes")["light"],
                    "base-100": "#fff",
                    "base-200": "#f9fafb",
                    "base-300": "#f0f0f0",
                    "base-content": "#000",
                    primary: "#000000",
                    "--rounded-btn": "1rem",
                },
                cyberpunk,
            },
        ],
    },
    safelist: ["text-warning", "text-danger", "text-success", "text-info"],
    plugins: [require("@tailwindcss/typography"), daisyui],
};
