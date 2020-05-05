<template>
    <ArrayItems :infos="infos" :items="brands" :storeActionGetItems="'brands/getBrandsWithPaginate'" :actionDeleteItem="'brands/deleteBrand'" :title="'marques'"/>
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
                brands: 'brands/brands',
                infos: 'products/infos'
            })
        },
        beforeMount() {
            this.$store.dispatch('brands/getBrandsWithPaginate', {page: 1, nb: 10})
        }
    }
</script>
