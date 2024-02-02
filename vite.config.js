import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/sass/welcome.scss",
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/js/bootstrap.js",
                "resources/js/buscar.js",
                "resources/js/cliente.js",
                "resources/js/cookies.js",
                "resources/js/pedido.js",
                "resources/js/user.js",
            ],
            refresh: true,
        }),
    ],
});
