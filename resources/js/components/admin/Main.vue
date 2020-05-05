<template>
	<div class="homeAdmin">
        <section class="containerLength boxShadow">
            <div class="bgUmbrella boxShadow">
                <p>{{products}}</p>
                <small>Products</small>
            </div>
            <div class="users boxShadow">
                <p>{{users}}</p>
                <small>Users</small>
            </div>
            <div class="brands boxShadow">
                <p>{{brands}}</p>
                <small>Brands</small>
            </div>
            <div class="newsLength boxShadow">
                <p>{{news}}</p>
                <small>News</small>
            </div>
        </section>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'

	export default {
        name: 'main',
	    computed: {
	        ...mapGetters({
                users: 'users/usersLength',
                products: 'products/productsLength',
                brands: 'brands/brandsLength',
                news: 'news/articlesLength'
            })
        },
        beforeMount() {
	        this.$store.dispatch('products/getProducts')
	        this.$store.dispatch('news/getArticles')
	        this.$store.dispatch('users/getUsers')
	        this.$store.dispatch('brands/getBrands')
        }
    }
</script>
<style lang="scss" scoped>
    .homeAdmin {
        max-width: 970px;
        margin: 0 auto;
        width: 100%;

        .containerLength {
            display: flex;
            justify-content: space-between;
            background: white;
            border-radius: 10px;
            padding: 0 15px 15px 15px;
            flex-wrap: wrap;

            div {
                margin-top: 15px;
                width: 200px;
                border-radius: 10px;
                padding: 15px;
                color: white;
                text-align: center;

                p {
                    font-size: 20px;
                }
            }

            .users {
                background: #fd397a;
            }

            .brands {
                background: #ffb822;
            }

            .newsLength {
                background: #35BFA3;
            }
        }
    }
</style>
