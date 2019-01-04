import VueRouter from 'vue-router'
import Axios from 'axios'
import VueProgressBar from 'vue-progressbar'
import Lightbox from 'vue-pure-lightbox'
import VueImg from 'v-img';
import linkify from 'vue-linkify'
import InputTag from 'vue-input-tag'


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueImg);

Vue.directive('linkified', linkify);

Vue.use(require('vue-moment'));

Vue.component('input-tag', InputTag);

Vue.use(VueRouter);

Vue.use(VueProgressBar, {
  color: 'green',
  failedColor: 'red',
  height: '10px'
})



const Register = Vue.component('regform', require('./components/Auth/RegForm.vue'));
const Login = Vue.component('loginform', require('./components/Auth/LoginForm.vue'));
const Home = Vue.component('datacomponent', require('./components/Home/Home.vue'));
const ShowProfile = Vue.component('profile', require('./components/Home/ShowProfile.vue'));
const Settings = Vue.component('settingscomponent', require('./components/Settings/Settings.vue'));


const routes = [
  { path: '/', component: Register },
  { path: '/login', component: Login },
  { path: '/home', component: Home },
  { path: '/profile/:id', component: ShowProfile },
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
