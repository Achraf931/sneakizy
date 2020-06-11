<template>
    <div class="containerProducts animation">
        <p class="bgWhite bRadius padding10" v-if="products.length === 0">Il n'y a aucune paire pour cette marque</p>
        <Product v-else v-for="product in products" :key="product.id" :brands="brands" :product="product"/>
    </div>
</template>
<script>
    import {mapGetters} from "vuex"
    import Product from "../Product"
    import Vue from 'vue'

    export default {
        name: 'brand',
        computed: {
            ...mapGetters({
                brands: 'brands/brands',
                products: 'products/productsWithPaginate'
            })
        },
        components: {
            Product
        },
        mounted() {
            Echo.channel('products')
                .listen('ProductAdded', (e) => {
                    this.products.push(e.product)
                })
            setTimeout(() => {
                let elem = document.querySelector('.animation')
                    elem.style.display = 'grid'
                    elem.style.opacity = '1'
            }, 50)
        }
    }
</script>
