<template>
    <div class="admin">
        <div class="boxShadow containerNavAdmin mrRight20 bRadius bgWhite">
            <router-link :class="{productsBg: routeName === 'admin/products'}" class="productsLength boxShadow" :to="{name: 'admin/products'}">
                <p>{{products}}</p>
                <small>Produits</small>
            </router-link>

            <router-link :class="{brandsBg: routeName === 'admin/brands'}" class="brands boxShadow" :to="{name: 'admin/brands'}">
                <p>{{brands}}</p>
                <small>Marques</small>
            </router-link>

            <router-link :class="{newsBg: routeName === 'admin/news'}" class="newsLength boxShadow" :to="{name: 'admin/news'}">
                <p>{{news}}</p>
                <small>Articles</small>
            </router-link>

            <router-link :class="{usersBgLength: routeName === 'admin/users'}" class="users boxShadow" :to="{name: 'admin/users'}">
                <p>{{users}}</p>
                <small>Utilisateurs</small>
            </router-link>
        </div>
        <router-view @logout="logout"></router-view>
    </div>
</template>
<script>
    import {mapGetters} from "vuex";

    export default {
        name: 'admin',
        data() {
            return {
                user: '',
                routeName: this.$route.name
            }
        },
        watch: {
            $route(to, from) {
                this.routeName = to.name
            }
        },
        computed: {
            ...mapGetters({
                users: 'users/usersLength',
                products: 'products/productsLength',
                brands: 'brands/brandsLength',
                news: 'news/articlesLength'
            })
        },
        beforeMount() {
            this.user = JSON.parse(localStorage.getItem('user'))
            this.$store.dispatch('products/getProducts')
            this.$store.dispatch('news/getArticles')
            this.$store.dispatch('users/getUsers')
            this.$store.dispatch('brands/getBrands')
        },
        methods: {
            logout() {
                this.$emit('logout')
            }
        }
    }
</script>
<style lang="scss" scoped>
    .admin {
        padding: 0 15px 40px 15px;

        & > .containerNavAdmin {
            max-width: 1050px;
            display: flex;
            justify-content: space-between;
            padding: 0 0 15px 0;
            margin: 0 auto 20px auto;

            a {
                border: none;
                margin: 15px 15px 0 15px;
                width: 200px;
                border-radius: 10px;
                padding: 15px;
                color: #93a2dd;
                background: #f0f3ff;
                text-align: center;
                height: fit-content;
                transition: all .2s ease;

                p {
                    font-size: 20px;
                }
            }

            a:hover {
                color: white!important;
            }

            .productsLength:hover {
                background: rgb(89, 29, 241);
            }

            .users:hover {
                background: #fd397a;
            }

            .brands:hover {
                background: #ffb822;
            }

            .newsLength:hover {
                background: #35BFA3;
            }

            .productsBg {
                background: rgb(89, 29, 241)!important;
                color: white!important;
            }

            .brandsBg {
                background: #ffb822!important;
                color: white!important;
            }

            .newsBg {
                background: #35BFA3!important;
                color: white!important;
            }

            .usersBgLength {
                background: #fd397a!important;
                color: white!important;
            }
        }
    }
    @media all and (max-width: 489px) {
        .admin > .containerNavAdmin {
            flex-wrap: wrap;

            & > a {
                width: 38.8%;
            }
        }
    }
</style>
