import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

const GET_PRODUCTS = 'GET_PRODUCTS';
const GET_SHOPPING_LISTS = 'GET_SHOPPING_LISTS';


Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        products: [],
        productId: [],
        shoppingListId: '',
        shoppingLists: []
    },
    mutations: {
        [GET_PRODUCTS](state, products) {
            state.products = products;
        },
        [GET_SHOPPING_LISTS](state, shoppingLists) {
            state.shoppingLists = shoppingLists;
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
        }
    },
    getters: {
        getProducts: state => state.products,
        getShoppingLists: state => state.shoppingLists
    }
})
