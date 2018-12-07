import VueRouter from 'vue-router'
import Axios from 'axios'
import VueProgressBar from 'vue-progressbar'
import Lightbox from 'vue-pure-lightbox'
import linkify from 'vue-linkify'


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(Lightbox);

Vue.directive('linkified', linkify);

Vue.use(require('vue-moment'));

Vue.use(VueRouter);

Vue.use(VueProgressBar, {
  color: 'green',
  failedColor: 'red',
  height: '10px'
})



const Register = Vue.component('regform', require('./components/Auth/RegForm.vue'));
const Login = Vue.component('loginform', require('./components/Auth/LoginForm.vue'));
const Home = Vue.component('datacomponent', require('./components/Home/Home.vue'));
const Settings = Vue.component('settingscomponent', require('./components/Settings/Settings.vue'));


const routes = [
  { path: '/', component: Register },
  { path: '/login', component: Login },
  { path: '/home', component: Home },
  { path: '/settings', component: Settings }
]

const router = new VueRouter({
    mode: 'history',
    routes
})


const app = new Vue({
    el: '#app',
    router
});
