<template>
    <div class="news">
        <ArticleItem v-for="article in articles" :key="article.id" :article="article"/>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    import ArticleItem from '../components/ArticleItem'
    export default {
        name: 'news',
        components: {
            ArticleItem
        },
        computed: {
            ...mapGetters({
                articles: 'news/articles'
            })
        },
        beforeMount() {
            this.$store.dispatch('news/getArticles')
        }
    }
</script>
<style lang="scss" scoped>
    .news {
        background: #F5F9FE;
        padding: 80px 0 40px 0;
        display: grid;
        grid-gap: 46px;
        justify-content: center;
        grid-template-columns: repeat(auto-fit, 300px);
    }
</style>
