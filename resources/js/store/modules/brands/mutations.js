import {bus} from "../../../app";

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
    state.brands.splice(state.brands.indexOf(response), 1)
    state.brandsWithPaginate.splice(state.brandsWithPaginate.indexOf(response), 1)
    bus.$emit('loading', false)
}
