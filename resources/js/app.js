/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import Toaster from 'v-toaster';
import App from './components/myapp/App.vue';
import router from './components/myapp/router/index'
import store from './components/myapp/store/index'
import  VueCookie from 'vue-cookies';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'v-toaster/dist/v-toaster.css'

window.Vue = require('vue');

Vue.use(BootstrapVue)
Vue.use(Toaster);
Vue.use(VueCookie);

Vue.component(
    'authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);



/*
<passport-clients></passport-clients>
<passport-authorized-clients></passport-authorized-clients>
<passport-personal-access-tokens></passport-personal-access-tokens>
*/
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        App
    },
    render: h => h(App),
    methods: {}
});
