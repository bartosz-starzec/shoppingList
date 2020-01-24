<template>
    <div v-if="alert.visibility" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Shopping List App</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ alert.message }}
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: "AlertComponent",
        computed: {
            ...mapGetters({
                alert: 'getAlert'
            })
        },
        watch: {
            alert: function () {
                setTimeout(() => {
                    this.alert.visibility = false
                }, 5000);
            }
        }
    }
</script>

<style scoped>

</style>
