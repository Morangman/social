import VueRouter from 'vue-router'
import Axios from 'axios';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);


const Register = Vue.component('regform', require('./components/Auth/RegForm.vue'));
const Login = Vue.component('loginform', require('./components/Auth/LoginForm.vue'));
const Home = Vue.component('datacomponent', require('./components/Home/Home.vue'));


const routes = [
  { path: '/', component: Register },
  { path: '/login', component: Login },
  { path: '/home', component: Home }
]

const router = new VueRouter({
    mode: 'history',
    routes
})


const app = new Vue({
    el: '#app',
    router
});
