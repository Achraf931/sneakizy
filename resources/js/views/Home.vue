<template>
    <div>
        <section>
            <div></div>
            <div class="containerSneakers">
                <div v-for="sneaker in sneakers.slice(0, 10)" :key="sneaker.id">
                    <div>
                        <router-link :to="{name: 'sneaker', params: {id: sneaker.id}}">
                            <h2>
                                {{sneaker.name}}<br>
                                <p>{{sneaker.color}}</p>
                            </h2>
                        </router-link>
                    </div>
                    <img :src="'/storage/img/' + sneaker.image" :alt="sneaker.name">
                </div>

            </div>
        </section>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "home",
        computed: {
            ...mapGetters({
                sneakers: 'sneakers/sneakers'
            })
        },
        beforeMount(){
            this.$store.dispatch('sneakers/getSneakers')
        }
    }
</script>

<style lang="scss" scoped>
    section {
        height: 100vh;
        width: 100%;
        display: flex;
        flex-direction: row;

        & > div {
            width: 50%;
            height: 100%;
        }

        & > div:first-child {
            background: #2c3e50;
        }
    }
    .containerSneakers {
        display: flex;
        flex-direction: row;
        overflow-x: auto;
        overflow-y: hidden;
        overscroll-behavior-x: contain;
        scroll-snap-type: x mandatory;

        & > div {
            position: relative;
            scroll-snap-align: start;
            width: 100%;
            min-width: 100%;
            height: 100%;

            & > div {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100%;
                position: absolute;
                left: 0;
                top: 0;
                background: rgba(0, 0, 0, 0.4);

                & > a > h2 {
                    text-align: center;
                    color: white;
                    font-size: 40px;
                    padding: 40px;
                    border-radius: 10px;
                    background: rgba(0, 0, 0, 0.7);

                    & > p {
                        font-size: 20px;
                        font-weight: normal;
                    }
                }
            }

            & > img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
    }
    @media all and (max-width: 749px) {
        section {
            flex-direction: column;

            & > div {
                width: 100%;
                max-height: 100vh;
            }
        }
    }
</style>
