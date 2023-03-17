import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    root: "./resources/js",
    rollupOptions: {
        input: {
            main: path.resolve(__dirname, "resources/js/app.js"),
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/css/app.css",
                "resources/js/app.js",
            ],
        }),
    ],
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
        },
    },
    optimizeDeps: {
        include: [
            "vue",
            "axios",
            "lodash",
            "jquery",
            "bootstrap",
            "@popperjs/core",
            "@popperjs/core/lib/popper-lite",
            "@popperjs/core/lib/enums",
            "@popperjs/core/lib/modifiers/applyStyles",
            "@popperjs/core/lib/modifiers/arrow",
            "@popperjs/core/lib/modifiers/flip",
            "@popperjs/core/lib/modifiers/offset",
            "@popperjs/core/lib/modifiers/preventOverflow",
        ],
    },
});
