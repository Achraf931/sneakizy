<template>
    <div>
        <article>
            <div>
                <div>
                    <img id="imgPrincipal" @click="openImage(sneaker.image)" :src="sneaker.image"
                         :alt="sneaker.name">
                </div>
                <div>
                    <div v-for="image in sneaker.images" :key="image.id">
                        <img @click="changeImage(image.image)" class="img" :src="image.image"
                             :alt="image.id">
                    </div>
                </div>
            </div>

            <div>
                <div id="containerNamePrice">
                    <h1>{{sneaker.brand}}</h1>
                    <h2 style="color: lightgray">{{sneaker.name}}</h2>
                    <small>{{sneaker.price}}€</small>
                </div>
                <h3>{{sneaker.description}}</h3>
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
                <button id="addBasket" @click.prevent="addToBasket()">Ajouter au panier</button>
                <h3 style="color: #28A744;">En stock</h3>
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
        name: 'sneaker',
        data() {
            return {
                size: '39',
                show: false,
                quantity: ''
            }
        },
        created() {
            this.$store.dispatch('sneakers/getSneaker', this.$route.params.id)
        },
        watch: {
            isImageVisible: function () {
                if (this.show) {
                    document.documentElement.style.overflow = 'hidden'
                    return
                }

                document.documentElement.style.overflow = 'auto'
            }
        },
        computed: {
            ...mapGetters({
                sneaker: 'sneakers/sneaker'
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
                this.sneaker.image = img
            },
            selected(e) {
                e.classList = 'selected'
            },
            addToBasket() {
                this.$store.dispatch('basket/AddSneakerToBasket', {
                    sneaker: this.sneaker,
                    quantity: 1,
                    size: this.size
                })
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
        padding: 120px 100px 0 100px;

        & > div:first-child {
            width: 60%;

            div {
                width: 100%;
            }

            & > div:first-child {
                width: 100%;
                max-width: 888px;
                height: 100%;
                max-height: 500px;

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
            width: 40%;
            padding-left: 30px;

            #containerNamePrice {
                position: relative;

                & > small {
                    position: absolute;
                    top: 0;
                    right: 0;
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

            #addBasket {
                padding: 10px 15px;
                border-radius: 10px;
                border: 2px solid black;
                background: black;
                color: white;
                font-weight: bold;
                font-size: 16px;
                margin-top: 30px;
                cursor: pointer;
            }
        }
    }

    @media all and (min-width: 1480px) {
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

            & > div:first-child {
                width: 100%;

                & > div:first-child {
                    max-height: none;
                    max-width: none;
                }
            }

            & > div:last-child {
                margin-top: 30px;
                padding-left: 0;
            }
        }
    }

    @media all and (max-width: 900px) {
        article > div:last-child {
            width: 100%;
        }
    }

    @media all and (max-width: 616px) {
        article {
            padding: 0 15px;

            & > div:last-child {
                width: 100%;
            }
        }
        #addBasket {
            width: 100%;
        }
    }
</style>
