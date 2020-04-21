<template>
    <div class="item">
        <router-link :to="{name: 'sneaker', params: {id: item.sneaker.id}}">
            <img :src="item.sneaker.image" :alt="item.sneaker.name">
        </router-link>
        <div class="containerInfo">
            <h3>{{item.sneaker.name}}</h3>
            <p>{{item.sneaker.color}}</p>
            <p>Taille / Pointure : {{item.size}}</p>
            <p>Quantité : {{item.quantity}}</p>
        </div>
        <font-awesome-icon class="delete" @click="removeItem(item)" icon="times"/>
        <p id="price">{{Math.round(item.sneaker.price * item.quantity)}}€</p>
    </div>
</template>
<script>
    export default {
        props: ['item'],
        methods: {
            removeItem(sneaker) {
                this.$emit('removeToBasket', sneaker)
            }
        }
    }
</script>
<style lang="scss" scoped>
    .item {
        display: flex;
        flex-direction: row;
        padding-bottom: 5px;
        position: relative;
        border-bottom: 0.5px solid black;

        & > a {
            width: 150px;
            height: 150px;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 10px;
            }
        }

        .containerInfo {
            margin-left: 20px;
            position: relative;
        }

        .delete {
            position: absolute;
            top: 0;
            color: #DC3445;
            right: 0;
            cursor: pointer;
        }

        #price {
            position: absolute;
            bottom: 0;
            right: 0;
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
