export default {
    namespaced: true,
    state: {
        sneakers: [],
        sneaker: {}
    },
    getters: {
        sneakers: state => {
            return state.sneakers
        },
        sneaker: state => {
            return state.sneaker
        }
    },
    mutations: {
        getSneakers(state, sneakers) {
            state.sneakers = sneakers
        },
        addSneaker(state, {sneakers}) {
            state.sneakers.push(sneakers)
        },
        setSneaker(state, sneaker) {
            state.sneaker = sneaker
        }
    },
    actions: {
        addSneaker({commit}, sneakers) {
            axios.post(`/api/sneakers`, sneakers)
                .then(sneakers => {
                    commit('addSneaker', {sneakers})
                })
                .catch(err => console.error(err))
        },

        getSneakers({commit}) {
            axios.get('/api/sneakers')
                .then(res => {
                    {
                        commit('getSneakers', res.data)
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        },

        getSneaker({commit}, sneaker) {
            axios.get(`/api/sneakers/${sneaker}`)
                .then(res => {
                    {
                        commit('setSneaker', res.data)
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
