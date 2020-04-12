<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <img :src="sneaker.image" :alt="sneaker.name">
                <h3 class="title" v-html="sneaker.name"></h3>
                <p class="text-muted">{{sneaker.description}}</p>
                <h4>
                    <span class="small-text text-muted float-left">$ {{sneaker.price}}</span>
                    <span class="small-text float-right">Available Quantity: {{sneaker.units}}</span>
                </h4>
                <br>
                <hr>
                <router-link :to="{ path: '/checkout?pid='+sneaker.id }" class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</router-link>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                sneaker : []
            }
        },
        beforeMount(){
            axios.get(`/api/sneakers/${this.$route.params.id}`)
            .then(response => {
                this.sneaker = response.data
            })
            .catch(error => {
                console.error(error);
            })
        }
    }
</script>
<style scoped>
    .small-text {
        font-size: 18px;
    }
    .title {
        font-size: 36px;
    }
</style>
