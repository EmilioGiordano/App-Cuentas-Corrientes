import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resouces/css/navbar.css',
                'resources/js/app.js',
                'resources/js/delete-button.js',
                'resources/css/datatable.css',
                'resources/css/service-index-badge.css',
                'resources/css/datatable.js',
                
            ],
            refresh: true,
        }),
    ],
});
