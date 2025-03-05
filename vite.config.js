import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    define: {
        'process.env': {
            VITE_PUSHER_APP_KEY: JSON.stringify(process.env.VITE_PUSHER_APP_KEY),
            VITE_PUSHER_APP_CLUSTER: JSON.stringify(process.env.VITE_PUSHER_APP_CLUSTER),
        },
    },
});
