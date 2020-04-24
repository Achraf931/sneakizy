<template>
    <div>
        <Nav @logout="logout" :lastname="lastname" :is_admin="is_admin" :isLoggedIn="isLoggedIn"/>
        <main>
            <router-view @loggedIn="change"></router-view>
            <Footer/>
        </main>
    </div>
</template>
<script>
    import Nav from '../components/Nav'
    import Footer from '../components/Footer'
    export default {
        data() {
            return {
                lastname: null,
                is_admin: false,
                isLoggedIn: localStorage.getItem('jwt') != null
            }
        },
        components: {
            Nav,
            Footer
        },
        mounted() {
            this.setDefaults()
        },
        methods: {
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
</style>
