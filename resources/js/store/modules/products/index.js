export default {
    namespaced: true,
    state: {
        products: [],
        product: {}
    },
    getters: {
        products: state => {
            return state.products
        },
        product: state => {
            return state.product
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

        getProducts({commit}) {
            axios.get('/api/products')
                .then(res => {
                    {
                        commit('getProducts', res.data)
                    }
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
