

require('./bootstrap');

window.Vue = require('vue');

import App from './App.vue';
import VueRouter from 'vue-router';
import Bulma from 'bulma';
import Lodash from 'lodash';
import routes from "./routes";

Vue.use(VueRouter);
Vue.use(Bulma);
Vue.use(Lodash);

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
