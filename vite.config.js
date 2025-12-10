import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from "path";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                "resources/css/app.css", 
                "resources/js/app.js",
                "resources/css/filament/admin/theme.css",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources"),
            "~": "/public",
        },
    },
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
