<template>
    <nav>
        <div @click="closeMenu" v-if="menu === true" class="bg"></div>
        <router-link style="color: #2c3e50!important;" :to="{name: 'home'}">Sneakizy</router-link>
        <font-awesome-icon @click="openMenu" v-if="window.width <= 837" icon="bars"/>
        <ul v-if="window.width > 837">
            <router-link :to="{name: 'home'}">Home</router-link>
            <router-link :to="{name: 'catalog'}">Catalogue</router-link>
            <router-link :to="{name: 'news'}">News</router-link>
            <router-link :to="{name: 'contact'}">Contact</router-link>
            <router-link :to="{ name: 'login' }" v-if="!isLoggedIn">Login</router-link>
            <router-link :to="{ name: 'register' }" v-if="!isLoggedIn">Register</router-link>
            <template v-if="isLoggedIn">
                <router-link :to="{ name: 'userboard' }" v-if="!is_admin"> Hi, {{lastname}}</router-link>
                <router-link :to="{ name: 'admin' }" v-if="is_admin"> Hi, {{lastname}}</router-link>
                <li v-if="isLoggedIn" @click="logout"> Logout</li>
            </template>
            <li style="position: relative;">
                <router-link style="margin-left: 0;" :to="{name: 'basket'}">
                    <font-awesome-icon style="color: #2c3e50; font-size: 20px; cursor: pointer" icon="shopping-basket"/>
                    <span v-if="basketItemCount > 0">{{basketItemCount}}</span>
                </router-link>
                <div v-if="basketItemCount > 0" style="width: 10px; height: 10px; position: absolute; top: -5px; right: -5px; background: red; border-radius: 100%;"></div>
            </li>
        </ul>

        <ul v-else id="mobileMenu">
            <router-link @click="closeMenu" :to="{name: 'home'}">Home</router-link>
            <router-link :to="{name: 'catalog'}">Catalogue</router-link>
            <router-link :to="{name: 'news'}">News</router-link>
            <router-link :to="{name: 'contact'}">Contact</router-link>
            <router-link @click="closeMenu" :to="{ name: 'login' }" v-if="!isLoggedIn">Login</router-link>
            <router-link @click="closeMenu" :to="{ name: 'register' }" v-if="!isLoggedIn">Register</router-link>
            <template v-if="isLoggedIn">
                <router-link @click="closeMenu" :to="{ name: 'userboard' }" v-if="!is_admin"> Hi, {{lastname}}</router-link>
                <router-link @click="closeMenu" :to="{ name: 'admin' }" v-if="is_admin"> Hi, {{lastname}}</router-link>
                <li v-if="isLoggedIn" @click="logout, closeMenu"> Logout</li>
            </template>
        </ul>
    </nav>
</template>
<script>
    import {mapGetters} from 'vuex'
    export default {
        props: ['lastname', 'isLoggedIn', 'is_admin'],
        data() {
            return {
                window: {
                    width: 0,
                    height: 0
                },
                menu: false
            }
        },
        computed: {
            ...mapGetters({
                basketItemCount: 'basket/basketItemCount'
            })
        },
        created() {
            window.addEventListener('resize', this.handleResize);
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize);
        },
        methods: {
            logout() {
                this.$emit('logout')
            },
            handleResize() {
                this.window.width = window.innerWidth;
                this.window.height = window.innerHeight;
            },
            openMenu() {
                this.menu = true
                document.getElementById('mobileMenu').style.display = 'flex'
                document.querySelector('body').style.overflow = 'hidden'
            },
            closeMenu() {
                this.menu = false
                document.getElementById('mobileMenu').style.display = 'none'
                document.querySelector('body').style.overflow = 'auto'
            }
        }
    }
</script>
<style lang="scss" scoped>
    .bg {
        background: rgba(0, 0, 0, 0.4);
        width: 100vw;
        height: 100vh;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 999;
        transition-duration: 400ms;
    }
    #mobileMenu {
        position: absolute;
        top: 0;
        right: -80vw;
        width: 70vw;
        height: 100vh;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background: black;
        z-index: 1000;
        display: none;
        animation: slideInUp 400ms forwards;

        a {
            color: white;
        }
    }
    @keyframes slideInUp {
        0% {
            right: -80vw;
            height: 100vh;
        }
        100% {
            right: 0;
            height: 100vh;
        }
    }
    nav {
        z-index: 70;
        position: fixed;
        width: 100vw;
        background: white;
        padding: 20px 100px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row;
        border-bottom: 0.5px solid lightgray;

        ul {
            display: flex;

            a, li {
                margin-left: 25px;
                font-weight: bold;
            }
            li {
                color: #DC3445;
                cursor: pointer;
            }
        }
    }

    @media all and (max-width: 837px) {
        nav {
            padding: 20px 15px;
        }
        ul:first-child {
            display: none!important;
        }
        #mobileMenu {
            display: none;
            position: absolute;
            top: 0;
            right: -80vw;
            width: 80vw;
            transition-duration: 400ms;
        }
        svg {
            cursor: pointer;
        }
    }
</style>
