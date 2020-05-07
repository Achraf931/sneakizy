<template>
    <ArrayItems :infos="infos" :items="articles" :storeActionGetItems="'news/getArticlesWithPaginate'" :actionDeleteItem="'news/deleteArticle'" :title="'articles'"/>
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
                articles: 'news/articlesWithPaginate',
                infos: 'news/infos'
            })
        },
        beforeMount() {
            this.$store.dispatch('news/getArticlesWithPaginate', {page: 1, nb: 10})
        }
    }
</script>
