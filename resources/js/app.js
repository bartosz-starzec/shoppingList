require("./bootstrap");

import Vue from "vue";
import VueAxios from "vue-axios";
import axios from "axios";
import router from "./router";
import store from './store';

import App from "./App.vue";

Vue.use(VueAxios, axios);

axios.defaults.baseURL = "http://127.0.0.1:8000/api";

const app = new Vue(Vue.util.extend({ router, store }, App)).$mount("#app");
