import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";
import fastifyStatic from "fastify-static";

export default defineConfig({
    server: {
        middleware: [fastifyStatic({ root: path.join(__dirname, "public") })],
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
        fallback: {
            path: require.resolve("path-browserify"),
        },
    },
});
