<template>
    <form v-if="display === true" class="form-inline" @submit.prevent="saveProduct">
        <div class="form-group">
            <label
                for="product-name"
                class="product-name d-block sr-only"
            >
                Product name:
            </label>
            <input
                type="text"
                name="product-id"
                id="product-id"
                class="form-control mr-2 d-none"
                placeholder="Id"
                v-model="product.id"
            />
            <input
                type="text"
                name="product-name"
                id="product-name"
                class="form-control mr-2"
                placeholder="Name"
                v-model="product.name"
            />
        </div>
        <div class="form-group">
            <button class="btn btn-success" v-if="editForm === true" @click="updateProduct">Edit product</button>
            <button class="btn btn-success" v-else>Add product</button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "ProductFormComponent",
        props: {
            display: Boolean,
            editForm: Boolean,
            product: Object
        },
        data() {
            return {
            }
        },
        methods: {
            saveProduct() {
                if(this.editForm === true) {
                    this.updateProduct();
                } else {
                    this.addProduct();
                }
            },
            checkForm() {
                if (!this.product.name || this.product.name === '') {
                    alert('Invalid name');
                    return false;
                }
                return true;
            },
            addProduct() {
                if (!this.checkForm()) {
                    return;
                }
                this.axios.post("products/create", this.product).then(() => {
                    this.product.name = "";
                    this.getProducts();
                });
            },
            updateProduct() {
                if (!this.checkForm()) {
                    return;
                }
                this.axios.post("products/update", this.product).then(() => {
                    this.product.name = "";
                    this.product.id = "";
                    this.getProducts();
                });
            },
            getProducts() {
                this.$store.dispatch('getProducts');
            },
        }
    }
</script>

<style scoped>

</style>
