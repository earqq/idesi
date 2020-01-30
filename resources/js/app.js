/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

const moment = require('moment')
require('moment/locale/es')


import router from './rutas';
import Axios from 'axios'
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.css'; 
import * as VueGoogleMaps from 'vue2-google-maps';

import VueMoment from 'vue-moment'
import VueTheMask from 'vue-the-mask'

import VueApexCharts from 'vue-apexcharts'

Vue.use(VueTheMask)
Vue.use(VueMoment, { moment })

Vue.prototype.$http = Axios
Vue.component('apexchart', VueApexCharts)


Vue.use(VueIziToast);
Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyBWbQ5eFoNQClbQuWWN7DvPHA5QsQS66Uc',
      libraries: 'places', // This is required if you use the Autocomplete plugin
    },
   
});

Vue.component('app', require('./components/AppComponent.vue').default);



const app = new Vue({
    el: '#app',
    router
});
