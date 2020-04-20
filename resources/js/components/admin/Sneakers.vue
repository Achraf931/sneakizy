<template>
	<div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>Sneaker</td>
                    <td>Price</td>
                    <td>Description</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(sneaker,index) in sneakers" @key="index" @dblclick="editingItem = sneaker">
                    <td>{{index+1}}</td>
                    <td v-html="sneaker.name"></td>
                    <td v-model="sneaker.price">{{sneaker.price}}</td>
                    <td v-model="sneaker.price">{{sneaker.description}}</td>
                </tr>
            </tbody>
        </table>
        <modal @close="addSneaker" v-show="addingSneaker != null"></modal>

        <button class="btn btn-primary" @click="addingSneaker = true">Add New Sneaker</button>
    </div>
</template>
<script>
    import Modal from './Modal'
    import {mapGetters} from "vuex";
	export default {
        data(){
            return {
                editingItem : null,
                addingSneaker : null
            }
        },
        components : {
            Modal
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
                    this.sneakers.push(e.sneaker)
                });
        },
        methods : {
            addSneaker(sneaker) {
                console.log(sneaker)
                this.addingSneaker = null
                this.$store.dispatch('sneakers/addSneaker', sneaker).catch(err => {
                    console.log(err)
                })

            }
        }
    }
</script>
