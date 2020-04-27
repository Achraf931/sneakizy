<template>
    <div class="catalog">
        <div id="containerBrands">
            <div :class="{line: brandName === 'All'}" style="border-bottom: 1px solid transparent;">
                <p class="all" @click="brandName = 'All'">All</p>
            </div>
            <div :class="{line: brandName === brand.name}" class="brands" v-for="brand in brands" :key="brand.index">
                <img @click="brandName = brand.name"
                     :src="brand.image" :alt="brand.name">
            </div>
        </div>
        <Brand :is="'Brand'" :brand="brandName"/>
    </div>
</template>

<script>
    import Brand from '../components/catalog/Brand'
    import {mapGetters} from 'vuex'

    export default {
        name: 'catalog',
        data() {
            return {
                count: '',
                brandName: 'All'
            }
        },
        components: {
            Brand
        },
        computed: {
            ...mapGetters({
                brands: 'brands/brands'
            })
        },
        mounted() {
            this.$store.dispatch('brands/getBrands')
            this.$store.dispatch('products/getProducts')
            setTimeout(() => {
                let elem = document.getElementById('containerBrands')
                    elem.style.display = 'flex'
                    elem.style.opacity = '1'
            }, 50)
        }
    }
</script>

<style lang="scss" scoped>
    .line {
        border-bottom: 1.5px solid black!important;
    }
    .catalog {
        padding-bottom: 40px;
        min-height: 100vh;
    }

    .banner {
        display: flex;
        justify-content: center;
        width: 100%;

        & > img {
            max-width: 600px;
            width: 100%;
            max-height: 250px;
            height: 100%;
        }
    }

    #containerBrands {
        display: none;
        opacity: 0;
        transition: opacity 500s;
        width: 50%;
        margin: auto;
        flex-direction: row;
        justify-content: space-around;
        align-items: flex-end;
        overflow-x: auto;
        overflow-y: hidden;
        overscroll-behavior-x: contain;
        scroll-snap-type: x mandatory;

        .all {
            scroll-snap-align: start;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 20px;
            height: 20px;
            color: white;
            font-weight: bold;
            background: black;
            border-radius: 100%;
            font-size: 12px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .brands {
            scroll-snap-align: start;
            width: 50px;
            height: 50px;
            margin: 0 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid transparent;

            & > img {
                width: 100%;
                cursor: pointer;
                transition-duration: 200ms;
            }
        }
        .brands:hover > img{
            transition-duration: 200ms;
            transform: scale(1.1);
        }
        .brands:first-child {
            margin-left: 0;
        }

        .brands:last-child {
            margin-right: 0;
        }
    }

    .containerProducts {
        margin-top: 20px;
        display: grid;
        grid-gap: 46px;
        width: 100%;
        justify-content: center;
        grid-template-columns: repeat(auto-fit, 300px);
    }

    @media all and (max-width: 645px) {
        .containerProducts {
            grid-gap: 10px;
        }
    }

    @media all and (max-width: 616px) {
        section {
            padding-bottom: 20px;
        }
    }
</style>
