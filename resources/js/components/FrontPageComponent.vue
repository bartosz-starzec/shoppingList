<template>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <alert-component></alert-component>
            <products-component></products-component>
            <shopping-list-form-component></shopping-list-form-component>
            <shopping-lists-component></shopping-lists-component>
        </div>
    </div>
</template>

<script>
    import ProductsComponent from "./ProductsComponent";
    import ShoppingListsComponent from "./ShoppingLists/ShoppingListsComponent";
    import AlertComponent from "./AlertComponent";
    import ShoppingListFormComponent from "./ShoppingLists/ShoppingListFormComponent";

    export default {
        components: {ShoppingListFormComponent, AlertComponent, ShoppingListsComponent, ProductsComponent},
        data() {
            return {
                product: {},
                products: [],
                selectedProducts: [],
                shoppingListId: '',
            };
        }
    };
</script>
