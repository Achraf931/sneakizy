<template>
    <div class="item">
        <router-link :to="{name: 'product', params: {id: item.product.id}}">
            <img :src="item.product.image" :alt="item.product.name">
        </router-link>
        <div class="containerInfo">
            <h3>{{item.product.name}}</h3>
            <p>{{item.product.color}}</p>
            <p>Taille / Pointure : {{item.size}}</p>
            <p>Quantité : {{item.quantity}}</p>
        </div>
        <font-awesome-icon class="delete" @click="removeItem(item)" icon="times"/>
        <p id="price">{{Math.round(item.product.price * item.quantity)}}€</p>
    </div>
</template>
<script>
    export default {
        props: ['item'],
        methods: {
            removeItem(product) {
                this.$emit('removeToBasket', product)
            }
        }
    }
</script>
<style lang="scss" scoped>
    .item {
        background-color: white;
        border-radius: 10px;
        display: flex;
        flex-direction: row;
        position: relative;

        & > a {
            width: 150px;
            height: 150px;
            padding: 8px;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 10px;
            }
        }

        .containerInfo {
            padding: 8px 0 8px 15px;
            position: relative;
        }

        .delete {
            position: absolute;
            top: 10px;
            color: #DC3445;
            right: 10px;
            cursor: pointer;
        }

        #price {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-weight: bold;
        }
    }

    @media all and (max-width: 640px) {
        .item {
            font-size: 14px;

            & > a {
                width: 100px;
                height: 100px;
            }
        }
    }
</style>
