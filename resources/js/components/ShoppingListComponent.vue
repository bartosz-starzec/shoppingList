<template>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
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
            <button class="btn btn-primary mb-3" @click="createShoppingList">
                Create new shopping list
            </button>
            <div v-for="shoppingList in shoppingLists" class="shoppingList card mb-5">
                <div class="card-header d-flex">
                    <button class="btn btn-link w-100 text-decoration-none text-left" type="button"
                            data-toggle="collapse"
                            :data-target="`#collapseShoppingList${shoppingList.id}`"
                            aria-expanded="false"
                            :aria-controls="`collapseShoppingList${shoppingList.id}`">
                        {{ shoppingList.name }}
                    </button>
                    <button @click="deleteShoppingList(shoppingList.id)">X</button>
                </div>

                <div class="collapse card-body" :id="`collapseShoppingList${shoppingList.id}`">
                    <ul>
                        <li v-for="shoppingListProduct in shoppingListProducts[shoppingList.id]">
                            {{shoppingListProduct.id}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {},
                products: [],
                shoppingListProducts: [],
                selectedProducts: [],
                shoppingLists: [],
                shoppingListId: '',
            };
        },
        created() {
            this.getProducts();
            this.getShoppingLists().then(() => {
                this.getShoppingListProducts();
            });
        },
        methods: {
            getProducts() {
                this.axios.get("/products").then(response => {
                    this.products = response.data.data;
                });
            },
            addProduct() {
                this.axios.post("products/create", this.product).then(() => {
                    this.product.name = "";
                    this.getProducts();
                });
            },
            addToShoppingList() {
                this.axios.post('shopping-list-products', {
                    shoppingListId: this.shoppingListId,
                    productsIds: this.selectedProducts
                }).then(() => {
                    this.getShoppingListProducts();
                })
            },
            deleteProducts() {
                if (confirm('Are you sure?')) {
                    this.axios.delete(`products/delete/${this.selectedProducts.toString()}`).then(() => {
                        this.getProducts();
                    });
                }
            },
            createShoppingList() {
                this.axios.post('shopping-lists/create').then(() => {
                    this.getShoppingLists();
                });
            },
            getShoppingLists() {
                return this.axios.get('shopping-lists').then((response) => {
                    this.shoppingLists = response.data.data;
                })
            },
            deleteShoppingList(id) {
                this.axios.delete(`shopping-lists/delete/${id}`).then(() => {
                    this.getShoppingLists();
                })
            },
            getShoppingListProducts() {
                this.shoppingLists.forEach((shoppingList) => {
                    this.axios.get(`shopping-list-products/${shoppingList.id}`).then((response) => {
                        this.$set(this.shoppingListProducts, shoppingList.id, response.data.data);
                    })
                });
            }
        }
    };
</script>
