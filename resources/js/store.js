import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

const GET_PRODUCTS = 'GET_PRODUCTS';
const GET_SHOPPING_LISTS = 'GET_SHOPPING_LISTS';
const SET_ACTIVE_SHOPPING_LIST = 'SET_ACTIVE_SHOPPING_LIST';
const SET_ALERT = 'SET_ALERT';


Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        products: [],
        productId: [],
        shoppingListId: '',
        shoppingLists: [],
        alert: {
            type: '',
            message: '',
            visibility: false
        }
    },
    mutations: {
        [GET_PRODUCTS](state, products) {
            state.products = products;
        },
        [GET_SHOPPING_LISTS](state, shoppingLists) {
            state.shoppingLists = shoppingLists;
        },
        [SET_ACTIVE_SHOPPING_LIST](state, shoppingListId) {
            state.shoppingListId = shoppingListId;
        },
        [SET_ALERT](state, alert) {
            state.alert = alert;
        }
    },
    actions: {
        getProducts({commit}) {
            return new Promise((resolve, reject) => {
                let products = [];
                axios.get("/products")
                    .then(response => {
                        products = response.data.data;
                        commit(GET_PRODUCTS, products);
                        resolve(products);
                    })
                    .catch(() => {
                        reject();
                    });
            });
        },
        getShoppingLists({commit}) {
            return new Promise((resolve, reject) => {
                let shoppingLists = [];
                axios.get('/shopping-lists')
                    .then(response => {
                        shoppingLists = response.data.data;
                        commit(GET_SHOPPING_LISTS, shoppingLists);
                        resolve(shoppingLists);
                    })
                    .catch(() => {
                        reject();
                    })
            })
        },
        setActiveShoppingList({commit}, props) {
            return new Promise((resolve, reject) => {
                commit(SET_ACTIVE_SHOPPING_LIST, props);
                resolve();
            })
                .catch(() => {
                    reject();
                })
        },
        setAlert({commit}, props) {
            return new Promise((resolve, reject) => {
                commit(SET_ALERT, props);
                resolve();
            }).catch(() => {
                reject();
            })
        }
    },
    getters: {
        getProducts: state => state.products,
        getShoppingLists: state => state.shoppingLists,
        getActiveShoppingList: state => state.shoppingListId,
        getAlert: state => state.alert
    }
})
