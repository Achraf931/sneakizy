export const getBrands = (state, brands) => {
    state.brands = brands
}

export const getBrandsWithPaginate = (state, brands) => {
    state.brandsWithPaginate = brands
}

export const getInfos = (state, infos) => {
    state.infos = infos
}

export const deleteBrand = (state, response) => {
    state.brands.splice(state.brands.indexOf(response), 1)
}
