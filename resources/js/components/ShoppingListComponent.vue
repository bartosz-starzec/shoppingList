<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="products card mb-4">
                <div class="card-header">
                    <button class="btn btn-link w-100 text-decoration-none text-left" type="button"
                            data-toggle="collapse" data-target="#collapseProducts"
                            aria-expanded="true" aria-controls="collapseProducts">
                        Products
                    </button>
                </div>
                <div class="collapseProducts card-body" id="collapseProducts">
                    <ul>
                        <li v-for="product in products">
                            {{ product.name }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="shoppingList card">
                <div class="card-header">
                    <button class="btn btn-link w-100 text-decoration-none text-left" type="button"
                            data-toggle="collapse"
                            data-target="#collapseShoppingList"
                            aria-expanded="true" aria-controls="collapseShoppingList">
                        Shopping List
                    </button>
                </div>

                <div class="collapseShoppingList card-body" id="collapseShoppingList">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                    Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                    proident.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                shoppingListProducts: []
            }
        },
        created() {
            let uri = 'http://127.0.0.1:8000/api/products';
            this.axios
                .get(uri)
                .then(response => {
                    this.products = response.data.data;
                })
        }
    }
</script>
