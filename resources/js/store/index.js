import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth/index'
import users from './modules/users/index'
import products from './modules/products/index'
import brands from './modules/brands/index'
import basket from './modules/basket/index'
import news from './modules/news/index'
import axios from 'axios'
axios.defaults.headers.common['Content-Type'] = 'application/json'
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        users,
        products,
        basket,
        brands,
        news
    }
})
