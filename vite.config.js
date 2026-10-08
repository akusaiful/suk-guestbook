import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/qr.js',
            ],
            refresh: true,
        }),
    ],

    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,

        origin: 'http://10.165.1.140:5173',

        hmr: {
            host: '10.165.1.140',
            port: 5173,
        },

        cors: {
            origin: 'http://10.165.1.140:8000',
        },
    },
});