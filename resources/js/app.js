import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

//ORUGA
import Oruga from '@oruga-ui/oruga-next';
import '@oruga-ui/theme-oruga/dist/scss/oruga-full.scss';
import CKEditor from '@ckeditor/ckeditor5-vue';




createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Oruga)
            .use(CKEditor)
            .use(ZiggyVue)
            .mount(el);

    },
    progress: {
        color: '#4B5563',
    },
});
