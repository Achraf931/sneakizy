export const AddProductToBasket = ({commit}, {product, quantity, size}) => {
    commit('AddToBasket', {product, quantity, size})
}

export const ClearBasket = ({commit}) => {
    commit('ClearBasket')
}

export const removeItemFromBasket = ({commit}, product) => {
    commit('RemoveToBasket', product)
}

export const EditProductInBasket = ({commit}, {id, data}) => {
    let product = {id: id, product: data}
    commit('EditQuantityOrSize', product)
}
