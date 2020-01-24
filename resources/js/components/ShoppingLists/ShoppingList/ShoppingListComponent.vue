<template>
    <div class="collapse card-body" :id="`collapseShoppingList${id}`">
        <ul v-if="products.length > 0" class="list-group">
            <li class="list-group-item" v-for="product in products" v-bind:key="product.id">
                <label :for="`shopping-list${id}-product${product.id}`"
                       class="form-group m-1 w-100 select-product d-flex align-items-center">
                    <input type="checkbox" class="mr-1" :name="product.id"
                           :id="`shopping-list${id}-product${product.id}`" :value="product.id"
                           v-model="selectedProducts">
                    {{ product.name }}

                </label>
            </li>
        </ul>
        <div v-else>
            Shopping list is empty! Select products from the list above and add them here.
        </div>
        <div v-if="products.length > 0" class="controls mt-3">
            <button class="btn btn-danger" @click="removeFromShoppingList">
                Delete products
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShoppingListComponent",
        props: ['id', 'products'],
        data() {
            return {
                selectedProducts: [],
                jobKey: 'deletedProducts'
            }
        },
        methods: {
            removeFromShoppingList() {
                if (confirm('Are you sure?')) {
                    this.axios.post(`shopping-lists/${this.id}/products/delete`, {
                        productsIds: this.selectedProducts,
                        jobKey: this.jobKey
                    }).then(() => {
                        this.checkForJobResult();
                        this.selectedProducts = [];
                    });
                }
            },
            checkForJobResult() {
                let counter = 0;
                const limit = 10;
                const interval = setInterval(() => {
                    this.getJobStatus()
                        .then((response) => {
                            if (Object.keys(response.data).length !== 0) {
                                this.$store.dispatch('getShoppingLists');
                                clearInterval(interval);
                            }
                            counter++;
                            if (counter === limit) {
                                this.$store.dispatch('getShoppingLists');
                                clearInterval(interval);
                            }
                        })
                }, 500);
            },
            getJobStatus() {
                return this.axios.post(`shopping-lists/job-status`, {
                    jobKey: this.jobKey
                }).then((response) => {
                    return response;
                })
            },
        }
    }
</script>
