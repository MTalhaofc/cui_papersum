import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: 'public/build', // Ensure this matches Laravel's expectations
        manifest: true, // Generate a manifest file for Laravel to use
    },
    server: {
        host: '0.0.0.0', // Ensure this is accessible from the Heroku environment
        port: 5173, // Make sure the port is available
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
