<template>
    <div>
        <input autocomplete="off" v-model="search" @keyup.enter="sendWithEnter" type="text" placeholder="ex. Air Jordan 1">
        <font-awesome-icon @click="sendSearch" style="color: #2c3e50; font-size: 20px; cursor: pointer" icon="search"/>
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
        watch: {
            search() {
                this.debounce()
            }
        },
        created() {
            this.debounce = _.debounce(this.sendSearch, 500)
        },
        methods: {
            sendSearch() {
                if (this.search === '') {
                    return
                }
                bus.$emit('search', this.search)
            },
            sendWithEnter() {
                this.sendSearch()
                if (this.search != '') {
                    if (this.$route.name !== 'searchingPage') {
                        this.$router.push({name: 'searchingPage'})
                    }
                }
                this.search = ''
            }
        }
    }
</script>
<style lang="scss" scoped>
    div {
        position: relative;
        width: 100%;
        height: 100%;
        max-height: 38px;

        svg {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: darkgrey!important;
        }
        input {
            width: 270px;
            padding: 4px 40px 4px 12px;
            font-size: 1rem;
            color: #000000;
            line-height: 1.4;
            text-transform: none;
            border-radius: 10px;
            background-clip: padding-box;
            background-color: #f5f4fa;
            border: none;
            box-sizing: border-box;
        }
        input::placeholder {
            color: darkgrey;
        }
    }
</style>
