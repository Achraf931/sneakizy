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
        max-width: 1000px;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;

        .containerLength {
            width: fit-content;
            display: flex;
            flex-direction: row;
            align-items: center;
            background: white;
            border-radius: 10px;
            padding: 15px 0;

            div {
                max-width: 200px;
                min-width: 200px;
                width: 100%;
                border-radius: 10px;
                padding: 15px;
                margin: 0 20px;
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
