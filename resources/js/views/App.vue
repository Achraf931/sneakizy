<template>
    <div style="min-height: 100vh" :class="mode ? 'dark' : ''">
        <!--<Loader/>-->
        <Nav @logout="logout" :lastname="lastname" :is_admin="is_admin" :isLoggedIn="isLoggedIn"/>
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
    import Loader from '../components/Loader'

    export default {
        data() {
            return {
                mode: false,
                search: '',
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
            bus.$on('mode', result => {
                localStorage.setItem('mode', result)
            })
            bus.$on('search', result => {
                this.search = result
            })
        },
        components: {
            Nav,
            Search,
            Footer,
            Loader
        },
        beforeMount() {
            window.addEventListener("DOMContentLoaded", () => {
                bus.$emit('loading', true)
                console.log("DOM entièrement chargé et analysé");
            });
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
    @font-face {
        font-family: Norms;
        src: url("/fonts/TTNorms-Regular.otf");
    }
    @font-face {
        font-family: NormsLight;
        src: url("/fonts/TTNorms-Light.otf");
    }
    @font-face {
        font-family: NormsBold;
        src: url("/fonts/TTNorms-Bold.otf");
    }
    @font-face {
        font-family: NormsBlack;
        src: url("/fonts/TTNorms-Black.otf");
    }
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        text-decoration: none;
        list-style: none;
        outline: none!important;
    }

    html, body {
        background-color: rgb(245,244,250);
        color: black;
        font-family: Norms, Poppins, Arial, sans-serif;
        font-weight: 200;
        scrollbar-base-color: #4536BB;
        scroll-behavior: smooth;
    }
    body::-webkit-scrollbar {
        width: 5px!important;
    }
    body::-webkit-scrollbar-thumb {
        mso-background: #4536BB;
        background: #4536BB!important;
    }
    ::selection {
        color: white;
        background: #4536BB;
    }
    .scrollbar-track-y {
        width: 4px !important;
    }
    button {
        background: #4536BB;
        font-family: Norms;
    }
    main {
        padding: 120px 0 0 0;
        width: 100%;
        max-width: 100vw;
    }
    .dark {
        background: radial-gradient(circle at top right, #252525, #2E2E2E, black);
        animation: opacity .2s;

        nav {
            background: transparent;

            ul .basketIcon > a svg {
                color: white;
            }

            .head > a > p {
                color: white!important;
            }

            ul, li, a {
                color: white;
            }
        }
    }
    .animation {
        display: none;
        opacity: 0;
        transition: opacity 500s;
    }
    .button {
        color: white;
        font-family: Norms;
        border: 1px solid #4536BB;
        background-color: #4536BB;
    }
    .button:active {
        transition: all 0.2s ease;
        transform: scale(0.96);
    }
    a {
        font-weight: bold;
        color: #2c3e50;

        &.router-link-exact-active {
            color: #4536BB!important;
        }
    }
    .fade-enter-active, .fade-leave-to {
        transition: opacity 500ms;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
