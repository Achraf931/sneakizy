<template>
    <div class="containerProducts">
        <Product v-for="product in shuffle(products)" :key="product.id"
                 v-if="brand !== 'All' ? product.brand === brand : brand = 'All'" :product="product"/>
    </div>
</template>
<script>
    import {mapGetters} from "vuex"
    import Product from "../Product"

    export default {
        name: 'brand',
        props: ['brand'],
        computed: {
            ...mapGetters({
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
