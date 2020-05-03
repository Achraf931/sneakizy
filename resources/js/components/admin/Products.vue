<template>
    <ArrayItems :infos="infos" :items="products" :storeActionGetItems="'products/getProductsWithPaginate'" :title="'produits'"/>
</template>
<script>
    import {mapGetters} from 'vuex'
    import ArrayItems from './ArrayItems'
    export default {
        components: {
            ArrayItems
        },
        computed: {
            ...mapGetters({
                products: 'products/products',
                infos: 'products/infos'
            })
        },
        beforeMount() {
            this.$store.dispatch('products/getProductsWithPaginate', {page: 1, nb: 10})
        }
    }
</script>
