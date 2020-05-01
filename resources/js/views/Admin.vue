<template>
    <div class="admin">
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        name: 'admin',
        data() {
            return {
                user: ''
            }
        },
        beforeMount() {
            this.user = JSON.parse(localStorage.getItem('user'))
        }
    }
</script>
<style lang="scss" scoped>

</style>
