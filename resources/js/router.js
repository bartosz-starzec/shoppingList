import Vue from 'vue';
import VueRouter from "vue-router";
Vue.use(VueRouter);

import HomeComponent from "./components/HomeComponent";
import ShoppingListComponent from "./components/ShoppingListComponent";

const routes = [
    {
        name: 'home',
        path: '/',
        component: HomeComponent
    },
    {
        name: 'shopping-list',
        path: '/shopping-list',
        component: ShoppingListComponent
    },
];

const router = new VueRouter({ mode: 'history', routes: routes});

export default router;
