<template>
    <div class="article">
        <h2>{{article.title}}</h2>
        <img :src="article.banner" :alt="article.title">
        <h2 class="marginBottom">{{article.summary}}</h2>
        <p>{{article.content}}</p>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    export default {
        name: 'article',
        computed: {
            ...mapGetters({
                article: 'news/article'
            })
        },
        beforeMount() {
            this.$store.dispatch('news/getArticle', this.$route.params.id)
        }
    }
</script>
<style lang="scss" scoped>
    .article {
        max-width: 1500px;
        width: 100%;
        margin: auto;
        padding: 80px 100px 40px 100px;

        .marginBottom {
            margin-bottom: 20px;
        }
        img {
            width: 100%;
            margin: 20px 0;
        }
        p {
            text-align: justify;
        }
    }
    @media all and (max-width: 616px) {
        .article {
            padding: 0 15px 40px 15px;
        }
    }
</style>
