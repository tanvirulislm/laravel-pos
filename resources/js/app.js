import { createInertiaApp, router } from '@inertiajs/vue3';
import { createApp, h } from 'vue';
import './bootstrap';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
        app.use(plugin)
        app.component('EasyDataTable', Vue3EasyDataTable)
        app.mount(el)
        },
})

import NProgress from 'nprogress';
router.on('start', () => {
    NProgress.start()
})
router.on('finish', () => {
    NProgress.done()
})
