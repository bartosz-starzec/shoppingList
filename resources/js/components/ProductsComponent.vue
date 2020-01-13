<template>
    <div class="products card mb-4">
        <div class="card-header">
            <button
                class="btn btn-link w-100 text-decoration-none text-left"
                type="button"
                data-toggle="collapse"
                data-target="#collapseProducts"
                aria-expanded="true"
                aria-controls="collapseProducts"
            >
                Products
            </button>
        </div>
        <div class="collapseProducts card-body" id="collapseProducts">
            <div class="products__new p-3">
                <button
                    class="btn btn-link w-100 text-decoration-none text-left"
                    type="button"
                    data-toggle="collapse"
                    data-target="#collapse-add-product"
                    aria-expanded="false"
                    aria-controls="collapse-add-product"
                >
                    Add new product &#x21e9
                </button>
                <div class="add-product collapse" id="collapse-add-product">
                    <form class="form-inline" @submit.prevent="addProduct">
                        <div class="form-group">
                            <label
                                for="prodcut-name"
                                class="prodcut-name d-block sr-only"
                            >
                                Product name:
                            </label>
                            <input
                                type="text"
                                name="prodcut-name"
                                id="prodcut-name"
                                class="form-control mr-2"
                                placeholder="Name"
                                v-model="product.name"
                            />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">+</button>
                        </div>
                    </form>
                </div>
            </div>

            <ul class="list-group">
                <li class="list-group-item" v-for="product in products" v-bind:key="product.id">
                    <label :for="product.id" class="form-group m-1 w-100 select-product">
                        <input type="checkbox" :name="product.id" :id="product.id" :value="product.id"
                               v-model="selectedProducts">
                        {{ product.name }}
                    </label>
                </li>
            </ul>
            <div class="controls mt-3">
                <select name="shoppingListId" id="shoppingListId" v-model="shoppingListId">
                    <option disabled value="">Please select one</option>
                    <option v-for="shoppingList in shoppingLists" :value="shoppingList.id">
                        {{ shoppingList.name }}
                    </option>
                </select>
                <button class="btn btn-primary" @click="addToShoppingList">
                    Add to shopping list
                </button>
                <button class="btn btn-danger" @click="deleteProducts">
                    Delete products
                </button>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: "ProductsComponent",
        data() {
            return {
                product: {},
                selectedProducts: [],
                shoppingListId: ''
            }
        },
        computed: {
            ...mapGetters({
                products: 'getProducts',
                shoppingLists: 'getShoppingLists'
            })
        },
        mounted() {
            this.getProducts();
        },
        methods: {
            addProduct() {
                this.axios.post("products/create", this.product).then(() => {
                    this.product.name = "";
                    this.getProducts();
                });
            },
            getProducts() {
                this.$store.dispatch('getProducts');
            },
            addToShoppingList() {
                // this.axios.post(`shopping-lists/${this.shoppingListId}/addProducts`, {
                //     productsIds: this.selectedProducts
                // });
            },
            deleteProducts() {
                if (confirm('Are you sure?')) {
                    this.axios.delete(`products/delete/${this.selectedProducts.toString()}`).then(() => {
                        this.getProducts();
                    });
                }
            },
        }
    }
</script>
