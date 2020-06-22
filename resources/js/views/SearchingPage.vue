<template>
    <div class="containerProducts animation">
        <template v-if="products.length > 0">
            <Product v-for="product in products" :key="product.id" :brands="brands" :product="product"/>
        </template>
        <template v-else>
            <p class="bgWhite bRadius padding10 widthContent mrAuto">Aucun résultat !</p>
        </template>
    </div>
</template>

<script>
    import Product from "../components/Product"
    import { mapGetters } from "vuex";
    export default {
        name: 'searchingPage',
        components: {
            Product
        },
        computed: {
            ...mapGetters({
                brands: 'brands/brands',
                products: 'products/products'
            })
        },
        mounted() {
            this.$store.dispatch('brands/getBrands')

            setTimeout(() => {
                document.querySelectorAll('.animation').forEach(elem => {
                    elem.style.opacity = '1'
                })
            }, 50)
        }
    }
</script>

<style lang="scss" scoped>
    .disabled {
        background-color: #F9F9FC!important;

        svg {
            color: #E1E4F5;
        }
    }
    .isActive {
        background: #591df1!important;
        color: white!important;
    }
    .line {
        border-bottom: 1.5px solid black!important;
    }

    .containerButtonsPage {
        opacity: 0;
        max-width: 290px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction:row;
        margin: 20px auto auto auto;
        background: white;
        padding: 15px;
        border-radius: 10px;

        .buttonPage, .arrowPagination {
            cursor: pointer;
            color: #93a2dd;
            width: 30px;
            border: none;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            margin: 0 8px;
            padding: 10px 15px;
            transition: all .3s ease;
        }

        .buttonPage:hover, .arrowPagination:hover {
            background-color: #591df1;
            color: white;
        }

        .arrowPagination {
            background-color: #f0f3ff;
        }
    }


    .containerProducts {
        margin-top: 20px;
        display: grid;
        grid-gap: 46px;
        width: 100%;
        justify-content: center;
        grid-template-columns: repeat(auto-fit, 300px);
    }

    @media all and (max-width: 645px) {
        .containerProducts {
            grid-gap: 10px;
        }
    }
</style>
