<template>
    <div class="containerProducts animation">
        <Product v-for="product in products" :key="product.id"
                 :brands="brands" :product="product"/>
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
                products: 'products/products'
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
        },
        methods: {
            shuffle(array) {
                let j = 0;
                let valI = '';
                let valJ = valI;
                let l = array.length - 1;
                while (l > -1) {
                    j = Math.floor(Math.random() * l);
                    valI = array[l];
                    valJ = array[j];
                    array[l] = valJ;
                    array[j] = valI;
                    l = l - 1;
                }
                return array;
            }
        }
    }
</script>
