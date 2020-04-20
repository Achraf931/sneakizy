<template>
    <div class="containerSneakers">
        <Sneaker v-for="sneaker in shuffle(sneakers)" :key="sneaker.id"
                 v-if="brand !== 'All' ? sneaker.brand === brand : brand = 'All'" :sneaker="sneaker"/>
    </div>
</template>
<script>
    import {mapGetters} from "vuex";
    import Sneaker from "../Sneaker";

    export default {
        name: 'brand',
        props: ['brand'],
        computed: {
            ...mapGetters({
                sneakers: 'sneakers/sneakers'
            })
        },
        components: {
            Sneaker
        },
        mounted() {
            Echo.channel('sneakers')
                .listen('SneakerAdded', (e) => {
                    this.sneakers.push(e.sneaker)
                })
        },
        methods: {
            shuffle(array) {
                let j = 0;
                let valI = '';
                let valJ = valI;
                let l = array.length - 1;
                while (l > -1) {
                    j = Math.floor(Math.random() * l);
                    valI = array[l];
                    valJ = array[j];
                    array[l] = valJ;
                    array[j] = valI;
                    l = l - 1;
                }
                return array;
            }
        }
    }
</script>
