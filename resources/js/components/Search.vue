<template>
    <div v-if="isSearching" class="searchBox">
        <div>
            <font-awesome-icon @click="closeSearching" class="close" icon="times"/>
            <input @keyup="searchProduct" type="text" v-model="search" placeholder="Rechercher">
        </div>
    </div>
</template>
<script>
    import {bus} from '../app'
    export default {
        props: ['isSearching'],
        data() {
            return {
                search: ''
            }
        },
        methods: {
            closeSearching() {
                bus.$emit('isSearching', false)
            },
            searchProduct() {
                this.$emit('search', this.search)
            }
        }
    }
</script>
<style lang="scss" scoped>
    .searchBox {
        position: absolute;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.4);
        z-index: 200;

        .close {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        div {
            position: relative;
            background-color: white;
            padding: 20px;
            z-index: 200;
            max-width: 1000px;
            width: 100%;
            border-radius: 10px;
        }
    }
</style>
