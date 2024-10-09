import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/dashboard.js',
                'resources/js/contato.js',
                'resources/js/alertas.js',
                'resources/js/cadastro.js',
            ],
            refresh: true,
        }),
    ],
});
