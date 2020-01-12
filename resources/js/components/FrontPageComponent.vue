<template>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <products-component></products-component>

            <button class="btn btn-primary mb-3" @click="createShoppingList">
                Create new shopping list
            </button>
           <shopping-list-component></shopping-list-component>
        </div>
    </div>
</template>

<script>
    import ProductsComponent from "./ProductsComponent";
    import ShoppingListComponent from "./ShoppingListComponent";

    export default {
        components: {ShoppingListComponent, ProductsComponent},
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
                    this.getShoppingLists();
                });
            },
        }
    };
</script>
