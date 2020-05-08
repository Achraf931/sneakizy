export const getProducts = (state, products) => {
    state.products = products
}


export const getProductsWithPaginate = (state, products) => {
    state.productsWithPaginate = products
}

export const addProduct = (state, {product}) => {
    state.products.unshift(product)
    state.productsWithPaginate.unshift(product)
}

export const setProduct = (state, product) => {
    state.product = product
}

export const getInfos = (state, infos) => {
    state.infos = infos
}

export const getProductsLength = (state, length) => {
    state.productsLength = length
}

export const deleteProduct = (state, response) => {
    state.products.splice(state.products.indexOf(response), 1)
    state.productsWithPaginate.splice(state.productsWithPaginate.indexOf(response), 1)
}
