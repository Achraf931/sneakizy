<template>
    <div v-if="notification.notification !== ''" class="containerNotifs zIndex200 paddingTop10">
        <p class="padding10 mrTop10 colorWhite bRadius" :class="{isError: notification.type === 0, isNotError: notification.type === 1}">
            {{notification.notification}}
        </p>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        computed: {
            ...mapGetters({
                notification: 'notifications/notification'
            })
        }
    }
</script>
<style lang="scss" scoped>
    .isError {
        background-color: red!important;
    }
    .isNotError {
        background-color: #6FBD13!important;
    }
    .containerNotifs {
        position: fixed;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);

        p {
            text-align: center;
            max-width: 280px;
            width: 100%;
            transition: all ease .2s;
        }
    }
</style>
