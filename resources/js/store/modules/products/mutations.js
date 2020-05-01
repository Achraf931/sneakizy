export const getProducts = (state, products) => {
    state.products = products
}

export const addProduct = (state, {product}) => {
    state.products.unshift(product)
}

export const setProduct = (state, product) => {
    state.product = product
}

export const getInfos = (state, infos) => {
    state.infos = infos
}
