<template>
    <ArrayItems :infos="infos" :items="products" :storeActionGetItems="'products/getProductsWithPaginate'" :actionDeleteItem="'products/deleteProduct'" :actionEditItem="'products/editProduct'" :actionCreateItem="'products/createProduct'" :getterItem="'products/product'"  :title="'produits'" :oneItem="'products/getProduct'"/>
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
                products: 'products/productsWithPaginate',
                infos: 'products/infos'
            })
        },
        beforeMount() {
            this.$store.dispatch('products/getProductsWithPaginate', {page: 1, nb: 10})
        }
    }
</script>
