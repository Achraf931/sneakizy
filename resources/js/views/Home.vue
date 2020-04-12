<template>
    <div>
        <section></section>
        <section>
            <div class="containerSneakers">
                <Sneaker v-for="sneaker in sneakers" :key="sneaker.id" :sneaker="sneaker"/>
            </div>
        </section>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import Sneaker from '../components/Sneaker'
    export default {
        name: "home",
        components: {
            Sneaker
        },
        computed: {
            ...mapGetters({
                sneakers: 'sneakers/sneakers'
            })
        },
        beforeMount(){
            this.$store.dispatch('sneakers/getSneakers')
        },
        mounted() {
            Echo.channel('sneakers')
                .listen('SneakerAdded', (e) => {
                    console.log(e)
                    console.log(this.sneakers)
                    this.sneakers.push(e.sneaker)
                });
        },
        methods: {
            addSneaker() {
                this.$store.dispatch('sneakers/addSneaker', sneaker).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    main {
        padding: 0 0 50px 0!important;
    }
    section:first-child {
        background: #2c3e50;
        height: 100vh;
        width: 100%;
    }
    section:last-child {
        padding-top: 50px;
    }
    .containerSneakers {
        display: grid;
        grid-gap: 46px;
        width: 100%;
        justify-content: center;
        grid-template-columns: repeat(auto-fit, 300px);
    }
    @media all and (max-width: 645px) {
        .containerSneakers {
            grid-gap: 10px;
        }
    }
</style>
