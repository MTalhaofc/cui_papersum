import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({




    server:{
        host: process.env.VITE_IP_ADDR || 'localhost',
        port: 5173, // Make sure the port is available
        strictPort: true,
   
fs:{
    strict:false,
},
}
,
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
