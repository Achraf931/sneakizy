import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth/index'
import sneakers from './modules/sneakers/index'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        sneakers
    }
})
