<template>
	<div class="row">
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <a href='/admin/orders'>Orders ({{orders.length}})</a>
        </div>
        <hr>
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
           	<a href='/admin/products'>Products ({{sneakers.length}})</a>
        </div>
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <a href='/admin/users'>Users ({{users.length}})</a>
        </div>
    </div>
</template>
<script>
	export default {
        data(){
            return {
                user : null,
                orders : [],
                sneakers : [],
                users : []
            }
        },
        mounted(){
            axios.get('/api/users/')
            .then(response => {
                this.users = response.data
            })
            .catch(error => {
                console.error(error);
            })

            axios.get('/api/sneakers/')
            .then(response => {
                this.sneakers = response.data
            })
            .catch(error => {
                console.error(error);
            })

            axios.get('/api/orders/')
            .then(response => {
                this.orders = response.data
            })
            .catch(error => {
                console.error(error);
            })
        }
    }
</script>
<style scoped>
    .big-text {
        font-size: 28px;
    }
	.product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
        height: 20vh
    }
</style>
