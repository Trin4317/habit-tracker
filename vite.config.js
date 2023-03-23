/// <reference types="vitest" />
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    // Allow connection to Vite server inside Docker container from host machine
    server: {
        host: true,
        hmr: {
            host: 'localhost'
        }
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    test: {
        environment: 'jsdom',
        setupFiles: 'tests/setup.js',
    },
});
