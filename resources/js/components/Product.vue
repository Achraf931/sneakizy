<template>
    <div class="product boxShadow">
        <div>
            <div class="brandImage">
                <div>
                    <img :src="brand.image" :alt="product.name">
                </div>
                <small>{{brand.name}}</small>
            </div>
            <h4>{{product.name}}</h4>
            <p v-if="product.color">{{product.color.slice(0, 24)}}</p>
            <p v-else>{{product.color}}</p>
            <small>{{Math.round(product.price)}}€</small>
            <router-link class="button" :to="{name: 'product', params: {id: product.id}}">Voir</router-link>
        </div>
        <div class="productImage">
            <img :src="product.image" :alt="product.name">
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                brand: '',
                size: '39',
                show: false,
                quantity: ''
            }
        },
        props: ['product', 'brands'],
        mounted() {
            this.brands.forEach(brand => {
                if (brand.name === this.product.brand) {
                    this.brand = brand
                }
            })
        },
        methods: {
            addToBasket() {
                this.$store.dispatch('basket/AddProductToBasket', {
                    product: this.product,
                    quantity: 1,
                    size: this.size
                })
            }
        }
    }
</script>
<style lang="scss" scoped>
    .product {
        transition: all .3s ease;
        max-width: 300px;
        width: 100%;
        background: white;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        .productImage {
            padding-top: 0;
            height: 187px;
            position: relative;

            div {
                width: calc(100% - 30px);
                height: calc(100% - 15px);
                opacity: 0;
                position: absolute;
                left: 50%;
                top: 0;
                transform: translateX(-50%);
                border-radius: 10px;
                background: rgba(0, 0, 0, 0.4);
                transition: opacity .2s;
                display: flex;
                justify-content: center;
                align-items: center;

                button {
                    padding: 10px 15px;
                    color: white;
                    font-size: 16px;
                    font-family: Norms, NormsLight, Arial, sans-serif;
                    border-radius: 10px;
                    cursor: pointer;
                }
            }
            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                max-height: 200px;
                border-radius: 10px;
            }
        }

        & > div {
            position: relative;
            padding: 15px;

            .brandImage {
                display: flex;
                flex-direction: row;
                align-items: center;
                margin-bottom: 10px;

                & > div {
                    width: 50px;
                    height: 50px;
                    border-radius: 100%;
                    box-shadow: 0 2px 5px rgba(69, 54, 187, 0.2);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 5px;

                    img {
                        width: 100%;
                    }
                }

                small {
                    margin-left: 10px;
                }
            }

            & > a {
                font-weight: bold;
                padding: 5px 10px;
                border-radius: 5px;
                position: absolute;
                bottom: 15px;
                right: 15px;
            }

            & > p {
                font-family: NormsLight, Norms, Arial, sans-serif;
                margin-bottom: 10px;
            }

            & > small {
                font-weight: bold;
                font-size: 16px;
            }
        }
    }
    .product:hover {
        box-shadow: 0 1px 21px 1px rgba(69,65,78,.12);
    }
</style>
