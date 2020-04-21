<template>
    <div class="sneaker">
        <img :src="sneaker.image" :alt="sneaker.name">
        <div>
            <h3>{{sneaker.name}}</h3>
            <h3>{{sneaker.color}}</h3>
            <small>{{Math.round(sneaker.price)}}€</small>
            <router-link :to="{name: 'sneaker', params: {id: sneaker.id}}">Voir</router-link>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['sneaker', 'brand']
    }
</script>
<style lang="scss" scoped>
    .sneaker {
        max-width: 300px;
        width: 100%;
        background: white;
        border-radius: 10px;
        box-shadow: 0 9px 30px #ebebeb82;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        &> div {
            position: relative;

            & > a {
                font-weight: bold;
                color: white;
                background: black;
                padding: 5px 10px;
                border-radius: 5px;
                position: absolute;
                bottom: 0;
                right: 0;
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
