<template>
    <ArrayItems :infos="infos" :items="users" :storeActionGetItems="'users/getUsersWithPaginate'" :actionDeleteItem="'users/deleteUser'" :actionEditItem="'users/editUser'" :actionCreateItem="'users/createUser'" :getterItem="'users/user'" :title="'utilisateurs'" :oneItem="'users/getUser'"/>
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
                users: 'users/usersWithPaginate',
                infos: 'users/infos'
            })
        },
        beforeMount() {
            this.$store.dispatch('users/getUsersWithPaginate', {page: 1, nb: 10})
        }
    }
</script>
