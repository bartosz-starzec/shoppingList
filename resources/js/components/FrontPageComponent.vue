<template>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <alert-component></alert-component>
            <products-component></products-component>

            <button class="btn btn-primary mb-3" @click="createShoppingList">
                Create new shopping list
            </button>
           <shopping-lists-component></shopping-lists-component>
        </div>
    </div>
</template>

<script>
    import ProductsComponent from "./ProductsComponent";
    import ShoppingListsComponent from "./ShoppingLists/ShoppingListsComponent";
    import AlertComponent from "./AlertComponent";

    export default {
        components: {AlertComponent, ShoppingListsComponent, ProductsComponent},
        data() {
            return {
                product: {},
                products: [],
                selectedProducts: [],
                shoppingListId: '',
            };
        },
        methods: {
            createShoppingList() {
                this.axios.post('shopping-lists/create').then(() => {
                    this.$store.dispatch('getShoppingLists');
                });
            },
        }
    };
</script>
