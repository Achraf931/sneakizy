<template>
    <div class="containerProducts">
        <article>
            <div>
                <h3>{{news[0].title}}</h3>
                <h4>{{news[0].content.slice(0, 250)}}...</h4>
                <router-link class="seeArticle" :to="{name: 'singleArticle', params: {id: news[0].id}}">
                    <button class="button">Lire l'article</button>
                </router-link>
            </div>
            <div>
                <img :src="news[0].banner" :alt="news[0].title">
            </div>
        </article>

        <div class="products">
            <Product v-for="product in products.slice(0, 10)" :key="product.id" :brands="brands" :product="product"/>
        </div>
    </div>
</template>

<script>
    import Product from "../components/Product";
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
            Product
        },
        beforeMount(){
            this.$store.dispatch('products/getProducts')
            this.$store.dispatch('brands/getBrands')
            this.$store.dispatch('news/getArticles')
        }
    }
</script>

<style lang="scss" scoped>
    .containerProducts {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 1000px;
        width: 100%;
        margin: auto;
        padding-bottom: 40px;

        article {
            display: flex;
            flex-direction: row;
            width: 100%;

            & > div:first-child {
                width: 35%;
                padding: 15px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                background-color: white;
                border-radius: 0 0 0 10px;

                h3 {
                    color: #4536BB;
                    font-family: NormsBold, Norms, Arial, sans-serif;
                }

                h4 {
                    line-height: 25px;
                }

                .seeArticle > button {
                    border: 1px solid #4536BB;
                    color: #4536BB;
                    font-family:  Norms, Arial, sans-serif;
                    font-size: 16px;
                    padding: 10px 15px;
                    border-radius: 10px;
                    background: white;
                    cursor: pointer;
                    transition: background .2s;
                }
                .seeArticle > button:hover {
                    background: #4536BB;
                    color: white;
                }
            }
            & > div:last-child {
                width: 65%;
                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 0 10px 10px 0;
                }
            }
        }

        & > .products {
            margin-top: 15px;
            max-width: 1000px;
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
    @media all and (max-width: 749px) {
        .containerProducts > article {
            flex-direction: column;

            & > div {
                width: 100%!important;
                border-radius: 0!important;

                img {
                    border-radius: 0!important;
                }
            }
        }
    }
</style>
