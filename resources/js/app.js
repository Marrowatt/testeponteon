require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// import { VueMaskDirective } from "v-mask";
// Vue.directive("mask", VueMaskDirective);

import VMask from "v-mask";

Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use(VMask);

Vue.component('formulario', require('./components/Formulario.vue').default);
Vue.component('recursive-modal', require('./components/RecursiveModal.vue').default);

import index from './components/Index.vue';

const routes = [
    { path: '/', component: index}
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    el: '#app',
    router: router,
});
