<template>
    <div v-if="loader" class="containerLoader"><div class="lds-ripple"><div></div><div></div></div></div>
</template>
<script>
    import {mapGetters} from "vuex";
    export default {
        computed: {
            ...mapGetters({
                loader: 'loader/loader'
            })
        }
    }
</script>
<style>
    .containerLoader {
        position: fixed;
        width: 100vw;
        height: 100vh;
        left: 0;
        top: 0;
        z-index: 500;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.1);
        transition: all .2s ease;
    }
    .lds-ripple {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }
    .lds-ripple div {
        position: absolute;
        border: 4px solid #3F44C9;
        opacity: 1;
        border-radius: 50%;
        animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }
    .lds-ripple div:nth-child(2) {
        animation-delay: -0.5s;
    }
    @keyframes lds-ripple {
        0% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 1;
        }
        100% {
            top: 0px;
            left: 0px;
            width: 72px;
            height: 72px;
            opacity: 0;
        }
    }
</style>
