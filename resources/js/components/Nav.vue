<template>
    <nav>
        <div @click="closeMenu" v-if="menu === true" class="bg"></div>
        <div class="head">
            <router-link style="color: #2c3e50!important; font-family: NormsBold; background: none!important;" :to="{name: 'home'}">
                <img style="width: 110px;" src="https://res.cloudinary.com/hyp1x6w5j/image/upload/v1593189236/sneakizy_qwvo1n.png" alt="logo">
            </router-link>
            <div class="searchBar">
                <Search/>
            </div>
        </div>
        <font-awesome-icon class="pAbsolute openMenu" @click="openMenu" v-if="window.width <= 837" icon="bars"/>
        <ul class="bottom" v-if="window.width > 837">
            <router-link :to="{name: 'home'}">Home</router-link>
            <router-link :class="{'router-link-exact-active': this.$route.name === 'brandProducts' || this.$route.name === 'product'}" :to="{name: 'catalog'}">Catalogue</router-link>
            <router-link :class="{'router-link-exact-active': this.$route.name === 'singleArticle'}" :to="{name: 'news'}">News</router-link>
            <router-link :to="{name: 'contact'}">Contact</router-link>
            <router-link :to="{ name: 'login' }" v-if="!isLoggedIn">Login</router-link>
            <router-link :to="{ name: 'register' }" v-if="!isLoggedIn">Register</router-link>
            <template v-if="isLoggedIn">
                <router-link :to="{ name: 'userboard' }" v-if="!is_admin"> Hi, {{lastname}}</router-link>
                <router-link :to="{ path: '/admin/' }" v-if="is_admin"> Hi, {{lastname}}</router-link>
            </template>
            <router-link class="basketIcon" :to="{name: 'basket'}">
                <li>
                    <font-awesome-icon icon="shopping-basket"/>
                    <transition v-if="basketItemCount > 0" name="fade">
                        <div style="width: 15px; height: 15px; position: absolute; top: 5px; right: 5px; font-family: NormsBold, Norms, Arial, sans-serif; background: #591df1; border-radius: 100%; font-size: 10px; color: white; display: flex; justify-content: center; align-items: center;">
                            {{basketItemCount}}
                        </div>
                    </transition>
                </li>
            </router-link>
        </ul>

        <ul v-else id="mobileMenu">
            <router-link @click="closeMenu" :to="{name: 'home'}">Home</router-link>
            <router-link @click="closeMenu" :class="{'router-link-exact-active': this.$route.name === 'brandProducts' || this.$route.name === 'product'}" :to="{name: 'catalog'}">Catalogue</router-link>
            <router-link @click="closeMenu" :class="{'router-link-exact-active': this.$route.name === 'singleArticle'}" :to="{name: 'news'}">News</router-link>
            <router-link @click="closeMenu" :to="{name: 'contact'}">Contact</router-link>
            <router-link @click="closeMenu" :to="{ name: 'login' }" v-if="!isLoggedIn">Login</router-link>
            <router-link @click="closeMenu" :to="{ name: 'register' }" v-if="!isLoggedIn">Register</router-link>
            <template v-if="isLoggedIn">
                <router-link @click="closeMenu" :to="{ name: 'userboard' }" v-if="!is_admin"> Hi, {{lastname}}</router-link>
                <router-link @click="closeMenu" :to="{ path: '/admin/' }" v-if="is_admin"> Hi, {{lastname}}</router-link>
            </template>
            <router-link @click="closeMenu" class="basketIcon" :to="{name: 'basket'}">
                <li>
                    <font-awesome-icon icon="shopping-basket"/>
                    <transition v-if="basketItemCount > 0" name="fade">
                        <div class="basketCount">
                            {{basketItemCount}}
                        </div>
                    </transition>
                </li>
            </router-link>
        </ul>
    </nav>
</template>
<script>
    import {mapGetters} from 'vuex'
    import Search from './Search'
    import {bus} from '../app'

    export default {
        props: ['lastname', 'isLoggedIn', 'is_admin'],
        data() {
            return {
                mode: false,
                window: {
                    width: 0,
                    height: 0
                },
                menu: false,
                isSearching: false
            }
        },
        components: {
            Search
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
            activeDark() {
                this.mode = !this.mode
                bus.$emit('mode', this.mode)
            },
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
    .basketCount {
        width: 15px;
        height: 15px;
        position: absolute;
        top: 5px;
        right: 5px;
        font-family: NormsBold, Norms, Arial, sans-serif;
        background: #591df1;
        border-radius: 100%;
        font-size: 10px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
    }
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

        & > a {
            color: #2c3e50;
            margin-top: 20px;
        }

        & > a:first-child {
            margin-top: 0;
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
        padding: 20px 100px 10px 100px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: column;
        border-bottom: 0.5px solid lightgray;

        & > .head {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;

            .searchBar {
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
            }
        }

        ul {
            width: 100%;
            justify-content: space-between;
            display: flex;
            font-size: 16px;

            .basketIcon {
                position: relative;
                margin-left: 0;

                li > svg {
                    color: #2c3e50!important;
                    font-size: 20px;
                    cursor: pointer;
                }
            }
        }
    }

    @media all and (max-width: 837px) {
        .openMenu {
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
        nav {
            padding: 20px 15px;
        }
        ul:first-child {
            display: none !important;
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
    @media all and (max-width: 440px) {
        nav > .head > .searchBar {
            top: 72%;
            transform: none;
        }
    }
</style>
