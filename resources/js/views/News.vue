<template>
    <div class="news animation">
        <ArticleItem v-for="article in articles" :key="article.id" :article="article"/>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    import ArticleItem from '../components/ArticleItem'
    import {bus} from '../app'

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
            setTimeout(() => {
                document.querySelectorAll('.animation').forEach(elem => {
                    elem.style.display = 'grid'
                    elem.style.opacity = '1'
                })
            }, 50)
        }
    }
</script>
<style lang="scss" >
    .animation {
        display: none;
        opacity: 0;
        transition: opacity .5s;
    }
    .news {
        padding-bottom: 40px;
        display: grid;
        grid-gap: 46px;
        justify-content: center;
        grid-template-columns: repeat(auto-fit, 300px);
    }
</style>
