<template>
    <ArrayItems :infos="infos" :items="brands" :storeActionGetItems="'brands/getBrandsWithPaginate'" :actionDeleteItem="'brands/deleteBrand'" :actionEditItem="'brands/editBrand'" :actionCreateItem="'brands/createBrand'" :getterItem="'brands/brand'" :title="'marques'" :oneItem="'brands/getBrand'"/>
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
                brands: 'brands/brandsWithPaginate',
                infos: 'brands/infos'
            })
        },
        beforeMount() {
            this.$store.dispatch('brands/getBrandsWithPaginate', {page: 1, nb: 10})
        }
    }
</script>
