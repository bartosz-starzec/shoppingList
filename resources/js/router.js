import Vue from 'vue';
import VueRouter from "vue-router";
Vue.use(VueRouter);

import FrontPageComponent from "./components/FrontPageComponent";

const routes = [
    {
        name: 'home',
        path: '/',
        component: FrontPageComponent
    },
];

const router = new VueRouter({ mode: 'history', routes: routes});

export default router;
