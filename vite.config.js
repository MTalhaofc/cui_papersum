import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
    },
    server: {
        host: process.env.VITE , // Use environment variable or default to '0.0.0.0'
         // Ensure the port is available and correct
        fs: {
            strict: false,
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
