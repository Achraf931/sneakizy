export const getProducts = (state, products) => {
    state.products = products
}

export const getProductsWithPaginate = (state, products) => {
    state.productsWithPaginate = products
}

export const addProduct = (state, product) => {state.products.push(product)
    state.productsWithPaginate.push(product)
}

export const editProduct = (state, product) => {
    let productInArray = state.productsWithPaginate.find(item => {
        return item.id === product.id
    })

    if (productInArray) {
        state.productsWithPaginate.forEach(item => {
            if (item.id === product.id) {
                item.is_published = product.is_published
                item.name = product.name
                item.price = product.price
                item.color= product.color
                item.description = product.description
                item.image = product.image
                item.release_date = product.release_date
                item.brand = product.brand
                item.brand_id = product.brand_id
            }
        })
    }
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
