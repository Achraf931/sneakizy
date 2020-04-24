<template>
	<div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Description</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product,index) in products" @key="index" @dblclick="editingItem = product">
                    <td>{{index+1}}</td>
                    <td v-html="product.name"></td>
                    <td v-model="product.price">{{product.price}}</td>
                    <td v-model="product.price">{{product.description}}</td>
                </tr>
            </tbody>
        </table>
        <modal @close="addSneaker" v-show="addingProduct != null"></modal>

        <button class="btn btn-primary" @click="addingProduct = true">Add New Product</button>
    </div>
</template>
<script>
    import Modal from './Modal'
    import {mapGetters} from "vuex";
	export default {
        data(){
            return {
                editingItem: null,
                addingProduct: null
            }
        },
        components : {
            Modal
        },
        computed: {
            ...mapGetters({
                products: 'products/products'
            })
        },
        beforeMount(){
            this.$store.dispatch('products/getProducts')
        },
        mounted() {
            Echo.channel('products')
                .listen('ProductAdded', (e) => {
                    this.products.push(e.product)
                });
        },
        methods : {
            addSneaker(product) {
                this.addingProduct = null
                this.$store.dispatch('products/addProduct', product).catch(err => {
                    console.log(err)
                })

            }
        }
    }
</script>
