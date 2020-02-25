/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

const moment = require('moment')
require('moment/locale/es')

import store from './store'
import router from './rutas';
import Axios from 'axios'
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.css'; 
import * as VueGoogleMaps from 'vue2-google-maps';
import Vuex from 'vuex'
import { ApolloClient } from 'apollo-client'
import { HttpLink } from 'apollo-link-http'
import { InMemoryCache } from 'apollo-cache-inmemory'
import VueApollo from 'vue-apollo'
/*google maps para geocoding */
import GoogleMapsLoader from "google-maps";
const mapsApiKey = "AIzaSyAbyVLUSddPTErLdnCbHoXpRO7Y1S4FuDA";
GoogleMapsLoader.KEY = mapsApiKey;
GoogleMapsLoader.LIBRARIES = ["geometry", "places"];

import VueMoment from 'vue-moment'
import VueTheMask from 'vue-the-mask'
import VueApexCharts from 'vue-apexcharts'
//apollo
const httpLink = new HttpLink({
  // You should use an absolute URL here
  uri: 'http://localhost:8000/graphql'
})
const apolloClient = new ApolloClient({
  link: httpLink,
  cache: new InMemoryCache(),
  connectToDevTools: true
})
Vue.use(VueApollo)
const apolloProvider = new VueApollo({
  defaultClient: apolloClient,
  defaultOptions: {
    $loadingKey: 'loading'
  }
})
Vue.use(VueTheMask)
Vue.use(VueMoment, { moment })
Vue.use(Vuex)

Vue.prototype.$http = Axios
Vue.component('apexchart', VueApexCharts)


Vue.use(VueIziToast);
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyAbyVLUSddPTErLdnCbHoXpRO7Y1S4FuDA',
    libraries: 'places,drawing,visualization,geometry, geocode',
  }
})


Vue.component('app', require('./components/AppComponent.vue').default);



const app = new Vue({
    el: '#app',
    router,
    store,
    provide: apolloProvider.provide(),
});
