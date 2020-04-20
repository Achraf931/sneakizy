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
                total += item.sneaker.price * item.quantity
            })
            return total
        }
    },
    mutations: {
        AddToBasket(state, {sneaker, quantity, size}) {
            let sneakerInBasket = state.basket.find(item => {
                return item.sneaker.id === sneaker.id
            })
            if (sneakerInBasket) {
                sneakerInBasket.quantity += quantity
                localStorage.setItem('basket', JSON.stringify(state.basket))
                return
            }
            state.basket.push({sneaker, quantity, size})
            localStorage.setItem('basket', JSON.stringify(state.basket))
        },
        RemoveToBasket(state, sneaker) {
            console.log()
            state.basket.splice(state.basket.indexOf(sneaker), 1)
            localStorage.setItem('basket', JSON.stringify(state.basket))
        }
    },
    actions: {
        AddSneakerToBasket({commit}, {sneaker, quantity, size}) {
            commit('AddToBasket', {sneaker, quantity, size})
        },
        removeItemFromBasket({commit}, sneaker) {
            commit('RemoveToBasket', sneaker)
        }
    }
}
