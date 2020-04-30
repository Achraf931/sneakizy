<template>
    <div class="containerProducts">
        <carousel class="boxShadow" :navigationEnabled="false" :centerMode="true" :paginationPadding="0" :paginationSize="0" paginationPosition="bottom-overlay" paginationColor="#F5F4FA" :speed="1000" paginationActiveColor="#4536BB" :autoplay="true" :autoplayHoverPause="true" :loop="true" :autoplayTimeout="5000" :per-page="1" :mouse-drag="true" id="splide">
            <slide v-for="article in news.slice(0, 5)" :key="article.index">
                <ItemArticle :article="article"/>
            </slide>
        </carousel>

        <div class="products">
            <Product v-for="product in products.slice(0, 10)" :key="product.id" :brands="brands" :product="product"/>
        </div>
    </div>
</template>

<script>
    import { Carousel, Slide } from 'vue-carousel';
    import Product from "../components/Product"
    import ItemArticle from "../components/ItemArticle"
    import {mapGetters} from 'vuex'
    export default {
        name: "home",
        computed: {
            ...mapGetters({
                brands: 'brands/brands',
                news: 'news/articles',
                products: 'products/products'
            })
        },
        components: {
            Product,
            ItemArticle,
            Carousel,
            Slide
        },
        beforeMount(){
            this.$store.dispatch('brands/getBrands')
            this.$store.dispatch('products/getProducts')
            this.$store.dispatch('news/getArticles')
        }
    }
</script>

<style lang="scss" scoped>
    .VueCarousel {
        width: 100%!important;
    }
    button.VueCarousel-navigation-button.VueCarousel-nativation-next {
        padding: 0!important;
        margin: 0!important;
        right: 55px!important!important;
    }
    .containerProducts {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 940px;
        width: 100%;
        height: fit-content;
        margin: auto;
        padding-bottom: 40px;

        & > .products {
            margin-top: 15px;
            justify-content: space-between;
            width: 100%;
            display: -webkit-inline-box;
            flex-direction: row;
            overflow-x: auto;
            overflow-y: hidden;
            overscroll-behavior-x: contain;
            scroll-snap-type: x mandatory;

            &::-webkit-scrollbar {
                display: none;
            }

            .products::-webkit-scrollbar-thumb {
                mso-background: #4536BB;
                background: #4536BB!important;
            }

            div {
                scroll-snap-align: center;
                margin-top: 15px;
                margin-left: 20px;
            }
            div:first-child {
                margin-left: 0;
            }
        }
    }
</style>
