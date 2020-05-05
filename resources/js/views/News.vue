<template>
    <div class="news animation">
        <content-loader
            v-if="skeleton"
            width="300"
            height="300"
            :speed="2"
            primaryColor="#f3f3f3"
            secondaryColor="#ecebeb">
            <rect x="0" y="0" rx="2" ry="2" width="350" height="350" />
        </content-loader>

        <ArticleItem v-for="article in articles" :key="article.id" :article="article"/>
    </div>
</template>
<script>
    import { ContentLoader } from "vue-content-loader"
    import {mapGetters} from 'vuex'
    import ArticleItem from '../components/ArticleItem'
    import {bus} from '../app'

    export default {
        name: 'news',
        data() {
            return {
                skeleton: true
            }
        },
        components: {
            ArticleItem,
            ContentLoader
        },
        computed: {
            ...mapGetters({
                articles: 'news/articles'
            })
        },
        created() {
            bus.$on('skeleton', res => {
                this.skeleton = res
            })
        },
        beforeMount() {
            this.$store.dispatch('news/getArticles', {page: 1, nb: 10})
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
