<template>
    <div class="products card mb-4">
        <div class="card-header">
            <button
                class="btn btn-link w-100 text-decoration-none text-left"
                type="button"
            >
                Products
            </button>
        </div>
        <div class="card-body">
            <div class="products__new p-3">
                <button
                    class="btn btn-primary text-left mb-2"
                    type="button"
                    @click="createProductForm"
                >
                    Add new product
                </button>
                <div class="add-product">
                    <product-form-component :display="displayForm" :editForm="editForm" :product="product"></product-form-component>
                </div>
            </div>

            <ul class="list-group">
                <li class="list-group-item" v-for="product in products" v-bind:key="product.id">
                    <label :for="product.id" class="form-group m-1 w-100 select-product d-flex align-items-center">
                        <input type="checkbox" class="mr-1" :name="product.id" :id="product.id" :value="product.id"
                               v-model="selectedProducts">
                        {{ product.name }}
                        <button class="btn btn-primary ml-auto"
                                data-toggle="collapse"
                                data-target="#collapse-add-product"
                                aria-expanded="false"
                                aria-controls="collapse-add-product"
                                @click="editProductForm(product.id)"
                        > Edit </button>
                    </label>
                </li>
            </ul>
            <div class="controls mt-3">
                <select name="shoppingListId" id="shoppingListId" @change="setShoppingListId" v-model="shoppingListId">
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

    import ProductFormComponent from "./ProductFormComponent";

    export default {
        name: "ProductsComponent",
        components: {ProductFormComponent},
        data() {
            return {
                product: {},
                selectedProducts: [],
                shoppingListId: '',
                displayForm: false,
                editForm: false
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
            createProductForm() {
                this.displayForm = true;
                this.editForm = false;
                this.product = {};
            },
            getProducts() {
                this.$store.dispatch('getProducts');
            },
            addToShoppingList() {
                this.axios.post(`shopping-lists/${this.shoppingListId}/add-products`, {
                    productsIds: this.selectedProducts
                })
                .then(() => {
                    this.$store.dispatch('getShoppingLists');
                    this.selectedProducts = [];
                });
            },
            deleteProducts() {
                if (confirm('Are you sure?')) {
                    this.axios.delete(`products/delete/${this.selectedProducts.toString()}`).then(() => {
                        this.getProducts();
                    });
                }
            },
            setShoppingListId() {
                this.$store.dispatch('setActiveShoppingList', this.shoppingListId);
            },
            editProductForm(id) {
                this.displayForm = true;
                this.editForm = true;
                const name = this.products.find(product => product.id === id).name;
                this.$set(this.product, 'name', name);
                this.$set(this.product, 'id', id);
            }
        }
    }
</script>
