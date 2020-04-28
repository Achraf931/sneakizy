<template>
    <div class="basket">
        <div class="containerBasket animation">
            <div class="containerItems">
                <h2>Panier</h2>
                <h4 style="margin-top: 20px;" v-if="basket.length === 0">Votre panier est actuellement vide.</h4>
                <div>
                    <ItemBasket @removeToBasket="removeToBasket" v-for="item in basket" :key="item.index" :item="item"/>
                </div>
            </div>
            <div class="rightPanel">
                <div>
                    <h2>Récapitulatif</h2>
                    <p>Sous-total <span>{{basketTotalPrice}}€</span></p>
                    <p>Frais de livraison <span>0,00€</span></p>
                    <h3>Total <span>{{ basketTotalPrice }}€</span></h3>
                    <hr>
                    <router-link :to="{name: 'checkout'}"><p ref="buttonScroll" :class="scrollY >= 398 ? 'positionButton' : ''" class="paiement button">Paiement</p></router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    import ItemBasket from '../components/ItemBasket'
    export default {
        name: 'basket',
        data() {
            return {
                scrollY: ''
            }
        },
        computed: {
            ...mapGetters({
                basket: 'basket/basket',
                basketItemCount: 'basket/basketItemCount',
                basketTotalPrice: 'basket/basketTotalPrice'
            })
        },
        components: {
            ItemBasket
        },

        mounted() {
            window.addEventListener('scroll', function(){
                this.scrollY = document.documentElement.scrollTop
                console.log(this.scrollY)
            })
        },
        beforeMount() {
            setTimeout(() => {
                let elem = document.querySelector('.animation')
                elem.style.display = 'flex'
                elem.style.opacity = '1'
            }, 50)
        },
        methods: {
            removeToBasket(product) {
                this.$store.dispatch('basket/removeItemFromBasket', product)
            }
        }
    }
</script>
<style lang="scss" >
    .basket {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        width: 100%;
        padding-bottom: 20px;

        .containerBasket {
            max-width: 1000px;
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;

            .rightPanel {
                width: 300px;
                font-weight: bold;

                & > div {
                    border-radius: 10px;
                    padding: 20px;
                    background: white;
                    position: fixed;
                    width: 300px;

                    &  > p, &  h3 {
                        margin-top: 20px;
                    }
                    & span {
                        float: right;
                    }
                    .paiement {
                        color: white;
                        font-weight: bold;
                        border-radius: 10px;
                        font-size: 18px;
                        margin-top: 20px;
                        padding: 10px 15px;
                        width: 100%;
                        text-align: center;
                    }
                }
            }
            .containerItems {
                width: calc(98% - 300px);

                h2 {
                    border-radius: 10px;
                    background-color: white;
                    padding: 10px 20px;
                }

                & > div {
                    width: 100%;

                    & > div {
                        margin-top: 20px;
                    }
                }
                & > div:first-child {
                    margin-top: 0;
                }
            }
        }
    }
    @media all and (max-width: 900px) {
        .positionButton {
            bottom: 75px!important;
        }
        .basket .containerBasket {
            flex-direction: column;
            padding: 0 15px;

            .containerItems {
                width: 100%;

            }
            .rightPanel {
                margin-top: 30px;
                width: 100%;
                padding-bottom: 60px;

                div {
                    position: initial;
                    width: 100%;

                    .paiement {
                        position: fixed;
                        bottom: 15px;
                        width: calc(100% - 30px);
                        left: 50%;
                        transform: translateX(-50%);
                    }
                }
            }
        }
    }
</style>
