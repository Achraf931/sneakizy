<template>
    <div class="admin">
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Admin Dashboard</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul style="list-style-type:none">
                        <li class="active"><button class="btn" @click="setComponent('main')">Dashboard</button></li>
                        <li><button class="btn" @click="setComponent('orders')">Orders</button></li>
                        <li><button class="btn" @click="setComponent('sneakers')">Sneakers</button></li>
                        <li><button class="btn" @click="setComponent('users')">Users</button></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <component :is="activeComponent"></component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Main from '../components/admin/Main'
    import Users from '../components/admin/Users'
    import Sneakers from '../components/admin/Sneakers'
    import Orders from '../components/admin/Orders'

    export default {
        name: 'admin',
        data(){
            return {
                user : null,
                activeComponent : null
            }
        },
        components : {
            Main,
            Users,
            Sneakers,
            Orders
        },
        beforeMount(){
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('user'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
        },
        methods : {
            setComponent(value){
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name : 'admin-pages', params : {page: 'users'}})
                        break;
                    case "orders":
                        this.activeComponent = Orders
                        this.$router.push({name : 'admin-pages', params : {page: 'orders'}})
                        break;
                    case "sneakers":
                        this.activeComponent = Sneakers
                        this.$router.push({name : 'admin-pages', params : {page: 'sneakers'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name : 'admin'})
                        break;
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    .admin {
        padding-top: 120px;
    }
    .hero-section {
        height: 20vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
</style>
