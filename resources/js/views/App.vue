<template>
    <div>
        <Nav @logout="logout" :lastname="lastname" :is_admin="is_admin" :isLoggedIn="isLoggedIn"/>
        <transition name="fade">
            <Search @search="searchProduct" :isSearching="isSearching"/>
        </transition>
        <main>
            <router-view @loggedIn="change"></router-view>
<!--           <Footer/>-->
        </main>
    </div>
</template>
<script>
    import Nav from '../components/Nav'
    import Search from '../components/Search'
    import Footer from '../components/Footer'
    import {bus} from '../app'

    export default {
        data() {
            return {
                isSearching: false,
                lastname: null,
                is_admin: false,
                isLoggedIn: localStorage.getItem('jwt') != null
            }
        },
        watch: {
            isSearching: function () {
                if (this.isSearching) {
                    document.documentElement.style.overflow = 'hidden'
                    return
                }

                document.documentElement.style.overflow = 'auto'
            }
        },
        created() {
            bus.$on('isSearching', result => {
                this.isSearching = result
            })
        },
        components: {
            Nav,
            Search,
            Footer
        },
        mounted() {
            this.setDefaults()
        },
        methods: {
            searchProduct(product) {
                axios.get('/api/products?search=' + product).then(res => {
                    console.log(res)
                })
            },
            setDefaults() {
                if (this.isLoggedIn) {
                    let user = JSON.parse(localStorage.getItem('user'))
                    this.lastname = user.lastname
                    this.is_admin = user.is_admin
                }
            },
            change() {
                this.isLoggedIn = localStorage.getItem('jwt') != null
                this.setDefaults()

            },
            logout() {
                localStorage.removeItem('jwt')
                localStorage.removeItem('user')
                this.change()
                this.$router.push('/')
            }
        }
    }
</script>
<style lang="scss">
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        text-decoration: none;
        list-style: none;
        outline: none!important;
    }

    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: Poppins!important;
        font-weight: 200;
    }

    main {
        padding: 0;
        width: 100%;
        max-width: 100vw;
    }

    a {
        font-weight: bold;
        color: #2c3e50;

        &.router-link-exact-active {
            color: #2067DD;
        }
    }
    .fade-enter-active, .fade-leave-to {
        transition: opacity 500ms;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
