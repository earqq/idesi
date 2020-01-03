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
import money from 'v-money'

// import WebCam from "vue-web-cam";

// import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
// import { Icon } from 'leaflet';
// import 'leaflet/dist/leaflet.css';

// Vue.component('l-map', LMap);
// Vue.component('l-tile-layer', LTileLayer);
// Vue.component('l-marker', LMarker);

// delete Icon.Default.prototype._getIconUrl;

// Icon.Default.mergeOptions({ 
//   iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
//   iconUrl: require('leaflet/dist/images/marker-icon.png'),
//   shadowUrl: require('leaflet/dist/images/marker-shadow.png')
// });

const VueInputMask = require('vue-inputmask').default


Vue.use(VueInputMask)
Vue.prototype.$http = Axios
Vue.use(VueIziToast);
Vue.use(money)

Vue.component('app', require('./components/AppComponent.vue').default);



const app = new Vue({
    el: '#app',
    router
});
