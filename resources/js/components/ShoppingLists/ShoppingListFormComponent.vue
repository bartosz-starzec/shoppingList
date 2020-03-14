<template>
    <form class="form-inline mb-3" @submit.prevent="createShoppingList">
        <div class="form-group">
            <label
                for="shopping-list-name"
                class="shopping-list-name d-block sr-only"
            >
                Shopping list name:
            </label>
            <input
                type="text"
                name="shopping-list-name"
                id="shopping-list-name"
                class="form-control mr-2"
                placeholder="Name"
                v-model="shoppingList.name"
            />
        </div>
        <div class="form-group">
            <button class="btn btn-success">Add shopping list</button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "ShoppingListFormComponent",
        data() {
            return {
                shoppingList: {
                    name: ''
                }
            }
        },
        methods: {
            createShoppingList() {
                this.axios.post('shopping-lists/create', {
                    name: this.shoppingList.name
                })
                    .then(() => {
                        this.$store.dispatch('getShoppingLists');
                    });
            },
        }
    }
</script>

<style scoped>

</style>
