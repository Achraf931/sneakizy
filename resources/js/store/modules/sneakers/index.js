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
        addSneaker(state, {sneaker}) {
            state.sneakers.unshift(sneaker)
        },
        setSneaker(state, sneaker) {
            state.sneaker = sneaker
        }
    },
    actions: {
        addSneaker({commit}, sneaker) {
            axios.post(`/api/sneakers`, sneaker, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    {
                        commit('addSneaker', res.data)
                    }
                })
                .catch(err => console.error(err))
        },

        getSneakers({commit}, page) {
            axios.get('/api/sneakers?page=' + page)
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
