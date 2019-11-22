/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import router from './rutas';
import Axios from 'axios'
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.css';


const VueInputMask = require('vue-inputmask').default


Vue.use(VueInputMask)
Vue.prototype.$http = Axios
Vue.use(VueIziToast);

Vue.component('app', require('./components/AppComponent.vue').default);



const app = new Vue({
    el: '#app',
    router
});
