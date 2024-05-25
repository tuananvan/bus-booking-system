/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./scripts/toggleRideFormInputs')
require('./scripts/confirmAlerts')
require('select2')

window.Vue = require('vue')

import flatpickr from "flatpickr"
window.flatpickr = flatpickr
require("flatpickr/dist/themes/light.css");


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/RouteLocationsInputs.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('route-locations-inputs', require('./components/RouteLocationsInputs.vue').default);
Vue.component('autocomplete-input', require('./components/AutocompleteInput.vue').default);
Vue.component('bar-chart', require('./components/BarChart').default);
Vue.component('doughnut-chart', require('./components/DoughnutChart').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
