import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/img/backgroundLogin.png',
                'resources/img/LogoPondok.svg',
                'resources/img/otp.png',
                'resources/img/registrasi.png',
                'resources/img/sukses.png'
        ],
            refresh: true,
        }),
    ],
    
});
