<template>
    <div class="product">
        <img :src="product.image" :alt="product.name">
        <div>
            <h3>{{product.name}}</h3>
            <h3>{{product.color}}</h3>
            <small>{{Math.round(product.price)}}€</small>
            <router-link class="button" :to="{name: 'product', params: {id: product.id}}">Voir</router-link>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['product', 'brand']
    }
</script>
<style lang="scss" scoped>
    .product {
        max-width: 300px;
        width: 100%;
        background: white;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 0 10px 0 0;
        }

        &> div {
            position: relative;
            padding: 20px;

            & > a {
                font-weight: bold;
                padding: 5px 10px;
                border-radius: 5px;
                position: absolute;
                bottom: 20px;
                right: 20px;
            }
            & > h3:nth-child(1) {
                font-weight: bold;
            }
            & > h3:nth-child(2) {
                font-weight: normal;
                margin-bottom: 10px;
            }
            & > small {
                font-weight: bold;
                font-size: 16px;
            }
        }
    }
</style>
