export const AddToBasket = (state, {product, quantity, size}) => {
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
}

export const RemoveToBasket = (state, product) => {
    state.basket.splice(state.basket.indexOf(product), 1)
    localStorage.setItem('basket', JSON.stringify(state.basket))
}