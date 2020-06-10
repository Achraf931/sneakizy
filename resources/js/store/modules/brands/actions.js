const headersReq = {'Content-Type': 'multipart/form-data'}

export const createBrand = ({commit}, brand) => {
    axios.post('/api/brands', brand, {headers: headersReq})
        .then(res => {
            commit('addBrand', res.data)
        })
        .catch(err => console.log(err))
}

export const getBrand = ({commit}, brand) => {
    axios.get(`/api/brands/${brand}`, {headers: headersReq})
        .then(res => {
            commit('setBrand', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const editBrand = ({commit}, {id, form}) => {
    axios.post(`/api/brands/` + id, form, {headers: headersReq})
        .then(res => {
            commit('addBrand', res.data)
        })
        .catch(err => console.error(err))
}

export const getBrands = ({commit}) => {
    axios.get('/api/brands', {headers: headersReq})
        .then(res => {
            commit('getBrands', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const getBrandsWithPaginate = ({commit, dispatch}, {page, nb, orderBy}) => {
    if (nb == null || nb == undefined || nb == false) {
        nb = 10
    }
    if (orderBy == null || orderBy == undefined || orderBy == false) {
        orderBy = 'ASC'
    }
    axios.get('/api/brands?page=' + page + '&max=' + nb + '&orderBy=' + orderBy, {headers: headersReq})
        .then(res => {
            commit('getBrandsWithPaginate', res.data.data)
            commit('getInfos', res.data)
            dispatch('admin/verifyCheckPageChange', res.data.data, {root: true})
        })
        .catch(err => {
            console.log(err)
        })
}

export const deleteBrand = ({commit}, id) => {
    axios.delete('/api/brands/' + id, {headers: headersReq})
        .then(res => {
            if (res.data.status) {
                commit('deleteBrand', res.data)
            }
        })
        .catch(err => {
            console.log(err)
        })
}
