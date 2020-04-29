<template>
    <div class="catalog">
        <div id="boxBrands">
            <div :class="{line: brandName === 'All'}" style="border-bottom: 1px solid transparent; height: 50px; margin-right: 10px; display: flex; align-items: center; justify-content: center">
                <p class="all" @click="brandName = 'All'">All</p>
            </div>
            <div id="containerBrands">

                <div :class="{line: brandName === brand.name}" class="brands" v-for="brand in brands" :key="brand.index">
                    <img @click="brandName = brand.name, banner = brand.banner"
                         :src="brand.image" :alt="brand.name">
                </div>
            </div>
        </div>

<!--        <div v-if="banner !== 'All' && banner !== ''" class="banner">
            <img :src="banner" :alt="banner">
        </div>-->
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
                banner: '',
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
                    elem.style.display = '-webkit-inline-box'
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

    #boxBrands {
        max-width: calc(100% - 200px);
        width: 100%;
        margin: auto;
        display: flex;
        border-radius: 10px;
        background: white;
        padding: 5px 15px;

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
        }

        #containerBrands {
            display: none;
            opacity: 0;
            margin: auto;
            width: fit-content;
            overflow-x: auto;
            overflow-y: hidden;
            overscroll-behavior-x: contain;
            scroll-snap-type: x mandatory;

            .brands {
                scroll-snap-align: center;
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
    }


    .containerProducts {
        margin-top: 20px;
        display: grid;
        grid-gap: 46px;
        width: 100%;
        justify-content: center;
        grid-template-columns: repeat(auto-fit, 300px);
    }
    @media all and (max-width: 838px) {
        #boxBrands {
            max-width: 100%;
        }
        ::-webkit-scrollbar {
            display: none;
        }
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
