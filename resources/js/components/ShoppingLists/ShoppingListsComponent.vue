<template>
    <div>
        <div v-for="shoppingList in shoppingLists" class="shoppingList card mb-5">
            <div :class="`card-header d-flex shopping-list-${shoppingList.id}`">
                <button class="btn btn-link w-100 text-decoration-none text-left" type="button"
                        data-toggle="collapse"
                        :data-target="`#collapseShoppingList${shoppingList.id}`"
                        aria-expanded="false"
                        :aria-controls="`collapseShoppingList${shoppingList.id}`">
                    {{ shoppingList.name }}
                </button>
                <button @click="deleteShoppingList(shoppingList.id)">X</button>
            </div>
            <shopping-list-component :id="shoppingList.id" :products="shoppingList.products"></shopping-list-component>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import ShoppingListComponent from "./ShoppingList/ShoppingListComponent";

    export default {
        name: "ShoppingListsComponent",
        components: {ShoppingListComponent},
        data() {
            return {
                selectedProducts: []
            }
        },
        computed: {
            ...mapGetters({
                shoppingLists: 'getShoppingLists'
            })
        },
        created() {
            this.getShoppingLists();
        },
        methods: {
            deleteShoppingList(id) {
                this.axios.delete(`shopping-lists/delete/${id}`).then(() => {
                    this.getShoppingLists();
                })
            },
            getShoppingLists() {
                this.$store.dispatch('getShoppingLists');
            },
        }
    }
</script>
