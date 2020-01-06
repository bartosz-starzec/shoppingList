require('./bootstrap');

import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import router from "./router";

import App from './App.vue';

Vue.use(VueAxios, axios);

axios.defaults.headers.common = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
};

const app = new Vue(Vue.util.extend({router}, App)).$mount('#app');
