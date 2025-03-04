import '../css/app.css';
import './bootstrap';

import {createInertiaApp, Head, Link} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createApp, h} from 'vue';
import {ZiggyVue} from 'ziggy-js';
import router from './Routes/Routes';
import {Layout} from "./Layouts/AppLayout.vue";


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .component("Layout", Layout)
            .component('Link', Link)
            .component('Head', Head)
            .use(router)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
}).then();
