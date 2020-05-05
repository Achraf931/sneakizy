<template>
    <div>
        <article>
            <div class="boxShadow">
                <div>
                    <img id="imgPrincipal" @click="openImage(product.image)" :src="product.image"
                         :alt="product.name">
                </div>
                <div>
                    <div v-for="image in product.images" :key="image.id">
                        <img @click="changeImage(image.image)" class="img" :src="image.image"
                             :alt="image.id">
                    </div>
                </div>
            </div>

            <div class="boxShadow">
                <div id="containerNamePrice">
                    <h1>{{product.brand}}</h1>
                    <h3>{{product.name}}</h3>
                    <small>{{product.price}}€</small>
                </div>
                <h3>{{product.description}}</h3>
                <div id="containerSize">
                    <h4>Sélectionner la taille</h4>
                    <div>
                        <p @click="selected">34</p>
                        <p style="background: #F7F7F7; color: #E4E4E4; border: 2px solid #E4E4E4;">35</p>
                        <p>36</p>
                        <p>37</p>
                        <p style="background: #F7F7F7; color: #E4E4E4; border: 2px solid #E4E4E4;">38</p>
                        <p>39</p>
                        <p>40</p>
                        <p>41</p>
                        <p>42</p>
                        <p style="background: #F7F7F7; color: #E4E4E4; border: 2px solid #E4E4E4;">43</p>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column">
                    <button class="button" id="addBasket" @mousemove="onMouseHover" @click.prevent="addToBasket">Ajouter au panier</button>
                    <button class="button" id="addFavorite" @click.prevent="addToBasket"><font-awesome-icon icon="heart"/> Ajouter aux favoris</button>
                </div>
                <div class="containerFiability">
                    <div>
                        <font-awesome-icon icon="truck"/>
                        <p>Livraison gratuite</p>
                    </div>
                    <div>
                        <font-awesome-icon icon="stopwatch"/>
                        <p>Expédition le jour même jusqu'à 13h</p>
                    </div>
                    <div>
                        <font-awesome-icon icon="lock"/>
                        <p>Paiement 100% sécurisé</p>
                    </div>
                </div>
            </div>
        </article>
        <transition name="fade">
            <div id="containerImgShow" v-if="show">
                <div>
                    <img id="imgShow" src="" alt="imagefullsize">
                    <font-awesome-icon @click="show = false" icon="times"/>
                </div>
            </div>
        </transition>
        <transition name="fade">
            <div @click="show = false" v-if="show" id="bg"></div>
        </transition>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'product',
        data() {
            return {
                inButton: false,
                size: '39',
                show: false,
                quantity: ''
            }
        },
        created() {
            this.$store.dispatch('products/getProduct', this.$route.params.id)
        },
        watch: {
            show: function () {
                if (this.show) {
                    document.documentElement.style.overflow = 'hidden'
                    return
                }

                document.documentElement.style.overflow = 'auto'
            }
        },
        computed: {
            ...mapGetters({
                product: 'products/product'
            })
        },
        methods: {
            openImage(img) {
                this.show = true
                setTimeout(() => {
                    document.getElementById('imgShow').src = img
                }, 10)
            },
            changeImage(img) {
                this.product.image = img
            },
            selected(e) {
                e.classList = 'selected'
            },
            addToBasket() {
                this.$store.dispatch('basket/AddProductToBasket', {
                    product: this.product,
                    quantity: 1,
                    size: this.size
                })
            },
            onMouseHover(e) {
                document.getElementById('addBasket').style.setProperty(
                    "background-position",
                    e.clientX - 15 + "px " + (e.clientY - 15) + "px"
                )
            }
        }
    }
</script>
<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-to {
        transition: opacity 500ms;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .selected {
        border: 2px solid white;
        background: black;
        color: white;
        transition-duration: 400ms;
    }

    #containerImgShow {
        width: 85vw;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 100;

        div {
            position: relative;
            width: 100%;
            height: 100%;

            svg {
                position: absolute;
                cursor: pointer;
                top: 15px;
                right: 15px;
                font-size: 20px;
            }

            #imgShow {
                width: 100%;
                border-radius: 10px;
            }
        }
    }

    #bg {
        background: rgba(0, 0, 0, 0.4);
        width: 100vw;
        height: 100vh;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 80;
    }

    article {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 0 100px 40px 100px;

        & > div {
            border-radius: 10px;
            background-color: white;
            padding: 20px;
            height: fit-content;
        }

        & > div:first-child {
            width: 54%;

            div {
                width: 100%;
            }

            & > div:first-child {
                width: 100%;
                max-width: 888px;

                img {
                    width: 100%;
                    height: 100%;
                    max-height: 500px;
                    object-fit: cover;
                    border-radius: 10px;
                    cursor: pointer;
                }
            }

            & > div:last-child {
                overflow-x: auto;
                overflow-y: hidden;
                overscroll-behavior-x: contain;
                scroll-snap-type: x mandatory;
                margin-top: 30px;
                display: grid;
                grid-gap: 29px;
                max-width: 888px;
                width: 100%;
                justify-content: start;
                grid-auto-flow: column;
                border-radius: 10px;
                grid-template-columns: repeat(auto-fit, 200px);

                &::-webkit-scrollbar {
                    display: none;
                }

                div {
                    scroll-snap-align: center;
                    width: 200px;
                    height: 125px;

                    & > img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        border-radius: 10px;
                        cursor: pointer;
                    }
                }
            }
        }

        & > div:last-child {
            width: 44%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

            #containerNamePrice {
                position: relative;

                & > h3 {
                    color: #4536BB;
                    margin-bottom: 20px;
                }

                & > small {
                    position: absolute;
                    top: 0;
                    right: 0;
                    color: #4536BB;
                    font-family: NormsBold, Norms, Arial, sans-serif;
                    font-style: italic;
                    font-weight: bold;
                    font-size: 16px;
                }
            }

            & > h3 {
                margin-bottom: 20px;
                color: gray;
            }

            #containerSize {
                display: flex;
                flex-direction: column;

                & > h4 {
                    font-weight: bold;
                    margin-bottom: 10px;
                }

                & > div {
                    display: inline-grid;
                    grid-gap: 6px;
                    justify-content: start;
                    grid-template-columns: repeat(auto-fit, 60px);

                    & > p {
                        border: 2px solid black;
                        width: 60px;
                        height: 40px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        cursor: pointer;
                        border-radius: 5px;
                        font-weight: bold;
                        transition-duration: 400ms;
                    }
                }

            }

            #addBasket, #addFavorite {
                padding: 10px 15px;
                border-radius: 10px;
                color: white;
                font-weight: bold;
                font-size: 16px;
                margin-top: 30px;
                cursor: pointer;
                position: relative;
                background-size: 0 0;
            }

            #addBasket::after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(farthest-side, rgba(245,244,250, 0.4) calc(100% - 1px), transparent 100%) fixed no-repeat;
                background-size: 30px 30px;
                background-position: inherit;
            }
            #addFavorite {
                margin-top: 10px;
                background-color: white;
                color: palevioletred;
                border: 1px solid palevioletred;
            }
            .containerFiability {
                margin-top: 20px;
                display: flex;
                flex-direction: row;
                justify-content: space-between;

                & > div {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    padding: 10px;
                    text-align: center;

                    p {
                        margin-top: 5px;
                    }
                }
            }
        }
    }

    @media all and (min-width: 600px) {
        #containerImgShow {
            width: unset;
            height: 85vh;

            div {
                position: relative;
                width: 100%;
                height: 100%;

                #imgShow {
                    width: unset;
                    height: 100%;
                    border-radius: 10px;
                }
            }
        }
    }

    @media all and (max-width: 1299px) {
        article {
            flex-direction: column;
            padding: 0 15px 15px 15px;

            & > div:first-child {
                width: 100%;

                & > div:first-child {
                    max-height: none;
                    max-width: none;

                    & > img {
                        max-height: 600px;
                    }
                }
                & > div:last-child {
                    max-width: unset;
                }
            }

            & > div:last-child {
                margin-top: 30px;
                width: 100%;

                #addBasket {
                    width: 100%;
                }
            }
        }
    }
</style>
