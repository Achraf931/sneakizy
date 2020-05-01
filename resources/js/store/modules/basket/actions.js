export const AddProductToBasket = ({commit}, {product, quantity, size}) => {
    commit('AddToBasket', {product, quantity, size})
}

export const removeItemFromBasket = ({commit}, product) => {
    commit('RemoveToBasket', product)
}
