require('./bootstrap');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import VueTailwind from 'vue-tailwind'
import VueSweetalert2 from 'vue-sweetalert2';


const settings = {
    //...
}

const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(VueTailwind, settings)
Vue.use(VueSweetalert2,options)

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
