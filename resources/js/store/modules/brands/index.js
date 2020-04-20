export default {
    namespaced: true,
    state: {
        brands: []
    },
    getters: {
        brands: state => {
            return state.brands
        }
    },
    mutations: {
        getBrands(state, brands) {
            state.brands = brands
        }
    },
    actions: {
        getBrands({commit}) {
            axios.get('/api/brands')
                .then(res => {
                    {
                        commit('getBrands', res.data)
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
