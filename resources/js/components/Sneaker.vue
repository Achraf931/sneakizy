<template>
    <div class="sneaker">
        <img :src="sneaker.image" :alt="sneaker.name">
        <div>
            <small>{{Math.round(sneaker.price)}}€</small>
            <h1>{{sneaker.brand.name}}</h1>
            <h2>{{sneaker.name}}</h2>
            <router-link :to="{name: 'sneaker', params: {id: sneaker.id}}">Voir</router-link>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['sneaker']
    }
</script>
<style lang="scss" scoped>
    .sneaker {
        max-width: 300px;
        width: 100%;
        background: white;
        border-radius: 10px;
        box-shadow: 0 9px 30px #EBEBEB;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
        }

        &> div {
            position: relative;

            & > a {
                font-weight: bold;
                color: white;
                background: black;
                padding: 5px 10px;
                border-radius: 5px
            }
            & > h2 {
                margin-bottom: 10px;
            }
            & > small {
                position: absolute;
                top: 0;
                right: 0;
                font-weight: bold;
                margin-top: 5px;
            }
        }
    }
</style>
