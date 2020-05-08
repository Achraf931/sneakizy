export const getBrands = (state, brands) => {
    state.brands = brands
}

export const getBrandsWithPaginate = (state, brands) => {
    state.brandsWithPaginate = brands
}

export const getInfos = (state, infos) => {
    state.infos = infos
}

export const setBrand = (state, brand) => {
    state.brands.push(brand)
    state.brandsWithPaginate.push(brand)
}

export const deleteBrand = (state, response) => {
    state.brandsWithPaginate.splice(state.brandsWithPaginate.indexOf(response), 1)
}
