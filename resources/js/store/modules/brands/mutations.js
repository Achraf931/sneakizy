export const getBrands = (state, brands) => {
    state.brands = brands
}

export const getBrandsWithPaginate = (state, brands) => {
    state.brandsWithPaginate = brands
}

export const getInfos = (state, infos) => {
    state.infos = infos
}

export const editBrand = (state, brand) => {
    let brandInArray = state.brandsWithPaginate.find(item => {
        return item.id === brand.id
    })

    if (brandInArray) {
        state.brandsWithPaginate.forEach(item => {
            if (item.id === brand.id) {
                item.name = brand.name
                item.image = brand.image
                item.banner = brand.banner
            }
        })
    }
}
export const addBrand = (state, brand) => {
    state.brands.unshift(brand)
    state.brandsWithPaginate.push(brand)
}

export const setBrand = (state, brand) => {
    state.brand = brand
}

export const deleteBrand = (state, response) => {
    state.brands.splice(state.brands.indexOf(response), 1)
    state.brandsWithPaginate.splice(state.brandsWithPaginate.indexOf(response), 1)
}
