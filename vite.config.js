import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({




    server:{
host:process.env.VITE_IP_ADDR,
   
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
