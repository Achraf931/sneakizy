export default {
    namespaced: true,
    state: {
        products: [],
        product: {},
        infos: {}
    },
    getters: {
        products: state => {
            return state.products
        },
        product: state => {
            return state.product
        },
        infos: state => {
            return state.infos
        }
    },
    mutations: {
        getProducts(state, products) {
            state.products = products
        },
        addProduct(state, {product}) {
            state.products.unshift(product)
        },
        setProduct(state, product) {
            state.product = product
        },
        getInfos(state, infos) {
            state.infos = infos
        }
    },
    actions: {
        addProduct({commit}, product) {
            axios.post(`/api/products`, product, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    {
                        commit('addProduct', res.data)
                    }
                })
                .catch(err => console.error(err))
        },

        getProducts({commit}, page) {
            axios.get('/api/products?page=' + page)
                .then(res => {
                    commit('getProducts', res.data.data)
                    commit('getInfos', res.data)
                })
                .catch(err => {
                    console.log(err)
                })
        },

        getBrandProducts({commit}, {id, page}) {
            axios.get('/api/brands/' + id + '/products?page=' + page)
                .then(res => {
                    commit('getProducts', res.data.data)
                    commit('getInfos', res.data)
                })
                .catch(err => {
                    console.log(err)
                })
        },

        getProduct({commit}, product) {
            axios.get(`/api/products/${product}`)
                .then(res => {
                    {
                        commit('setProduct', res.data)
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
