import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth/index'
import sneakers from './modules/sneakers/index'
import brands from './modules/brands/index'
import basket from './modules/basket/index'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        sneakers,
        basket,
        brands
    }
})
