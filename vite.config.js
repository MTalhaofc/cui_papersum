import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: 'public/build', // Ensure this matches Laravel's expectations
        manifest: true, // Generate manifest file
    },
    server: {
        host: process.env.VITE_IP_ADDR || '0.0.0.0', // Use environment variable or default to '0.0.0.0'
        port: 5173, // Ensure the port is available and correct
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
