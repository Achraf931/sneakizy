<template>
    <ArrayItems :infos="infos" :items="users" :storeActionGetItems="'users/getUsers'" :title="'utilisateurs'"/>
</template>
<script>
    import {mapGetters} from 'vuex'
    import ArrayItems from './ArrayItems'
    export default {
        components: {
            ArrayItems
        },
        computed: {
            ...mapGetters({
                users: 'users/users',
                infos: 'users/infos'
            })
        },
        beforeMount() {
            this.$store.dispatch('users/getUsers', {page: 1, nb: 10})
        }
    }
</script>
