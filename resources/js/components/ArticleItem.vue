<template>
    <router-link class="boxShadow" :to="{name: 'singleArticle', params: {id: article.id}}">
        <div class="article">
            <img :src="article.image" :alt="article.title">
            <div></div>
            <h3>{{article.title}}</h3>
        </div>
    </router-link>
</template>
<script>
    export default {
        props: ['article']
    }
</script>
<style lang="scss" scoped>
    .article {
        width: 300px;
        height: 300px;
        position: relative;
        cursor: pointer;

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        div {
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1;
            transition-duration: 200ms;
        }

        h3 {
            opacity: 0;
            position: absolute;
            left: 10px;
            bottom: 10px;
            color: white;
            z-index: 20;
            transition-duration: 200ms;
        }
    }
    .article:hover div {
        opacity: 1;
        transition-duration: 200ms;
    }
    .article:hover h3 {
        opacity: 1;
        transition-duration: 200ms;
    }
</style>
