import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/navbar.css',
                'resources/css/services-index-badge.css',
                'resources/css/services-index-edit-disabled.css',
                'resources/js/app.js',
                'resources/js/delete-button.js',
                'resources/js/edit-service-button.js',
                'resources/css/datatable.css',
                'resources/js/datatable.js',
            ],
            refresh: true,
        }),
    ],
});
