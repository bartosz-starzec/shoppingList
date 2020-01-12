<template>
    <div>
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
                    <li v-for="shoppingListProduct in shoppingList.products">
                        {{shoppingListProduct.name}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShoppingListComponent",
        data() {
            return {
                shoppingLists: []
            }
        },
        mounted() {
            this.getShoppingLists();
        },
        methods: {
            deleteShoppingList(id) {
                this.axios.delete(`shopping-lists/delete/${id}`).then(() => {
                    this.getShoppingLists();
                })
            },
            getShoppingLists() {
                return this.axios.get('shopping-lists').then((response) => {
                    this.shoppingLists = response.data.data;
                })
            },
        }
    }
</script>
