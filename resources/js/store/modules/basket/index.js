export default {
    namespaced: true,
    state: {
        basket: JSON.parse(localStorage.getItem('basket')) !== null ? JSON.parse(localStorage.getItem('basket')) : []
    },
    getters: {
        basket: state => {
            return state.basket
        },
        basketItemCount: state => {
            return state.basket.length
        },
        basketTotalPrice: state => {
            let total = 0
            state.basket.forEach(item => {
                total += item.product.price * item.quantity
            })
            return total
        }
    },
    mutations: {
        AddToBasket(state, {product, quantity, size}) {
            let productInBasket = state.basket.find(item => {
                return item.product.id === product.id
            })
            if (productInBasket) {
                productInBasket.quantity += quantity
                localStorage.setItem('basket', JSON.stringify(state.basket))
                return
            }
            state.basket.push({product, quantity, size})
            localStorage.setItem('basket', JSON.stringify(state.basket))
        },
        RemoveToBasket(state, product) {
            state.basket.splice(state.basket.indexOf(product), 1)
            localStorage.setItem('basket', JSON.stringify(state.basket))
        }
    },
    actions: {
        AddProductToBasket({commit}, {product, quantity, size}) {
            commit('AddToBasket', {product, quantity, size})
        },
        removeItemFromBasket({commit}, product) {
            commit('RemoveToBasket', product)
        }
    }
}
