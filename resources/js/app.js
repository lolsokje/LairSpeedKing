import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import route from 'ziggy-js';
import 'bootstrap';
import '../scss/app.scss';
import Admin from './Shared/Layouts/Admin.vue';
import Main from './Shared/Layouts/Main.vue';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    resolve: name => {
        const page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));

        page.then((module) => {
            if (module.default.layout === undefined) {
                module.default.layout = name.includes('Admin') ? Admin : Main;
            }
        });

        return page;
    },
    setup ({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin, ZiggyVue)
            .mixin({ methods: { route } })
            .component('InertiaLink', Link)
            .mount(el);
    },
});
