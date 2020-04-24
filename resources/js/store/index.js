import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth/index'
import products from './modules/products/index'
import brands from './modules/brands/index'
import basket from './modules/basket/index'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        products,
        basket,
        brands
    }
})
