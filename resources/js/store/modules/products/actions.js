import {bus} from '../../../app'

const headersReq = {'Content-Type': 'multipart/form-data'}

export const createProduct = ({commit}, product) => {
    axios.post(`/api/products`, product, {headers: headersReq})
        .then(res => {
            commit('addProduct', res.data)
        })
        .catch(err => console.error(err))
}

export const editProduct = ({commit}, {id, form}) => {
    axios.post(`/api/products/` + id, form, {headers: headersReq})
        .then(res => {
            commit('addProduct', res.data)
        })
        .catch(err => console.error(err))
}

export const getProduct = ({commit}, product) => {
    axios.get(`/api/products/${product}`, {headers: headersReq})
        .then(res => {
            commit('setProduct', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const getProducts = ({commit}) => {
    axios.get('/api/products', {headers: headersReq})
        .then(res => {
            commit('getProducts', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const getProductsWithPaginate = ({commit, dispatch}, {page, nb, orderBy}) => {
    if (nb == null || nb == undefined || nb == false) {
        nb = 8
    }

    if (orderBy == null || orderBy == undefined || orderBy == false) {
        orderBy = 'ASC'
    }

    axios.get('/api/products?page=' + page + '&max=' + nb + '&orderBy=' + orderBy, {headers: headersReq})
        .then(res => {
            commit('getProductsWithPaginate', res.data.data)
            commit('getInfos', res.data)
            dispatch('admin/verifyCheckPageChange', res.data.data, {root: true})
        })
        .catch(err => {
            console.log(err)
        })
}

export const getBrandProducts = ({commit}, {id, page, nb}) => {
    if (nb == null || nb == undefined || nb == false) {
        nb = 8
    }
    axios.get('/api/brands/' + id + '/products?page=' + page + '&max=' + nb, {headers: headersReq})
        .then(res => {
            commit('getProducts', res.data.data)
            commit('getInfos', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const deleteProduct = ({commit}, id) => {
    axios.delete('/api/products/' + id, {headers: headersReq})
        .then(res => {
            if (res.data.status) {
                commit('deleteProduct', res.data)
            }
        })
        .catch(err => {
            console.log(err)
        })
}

export const getProductsLength = ({commit}) => {
    axios.get('/api/products/length', {headers: headersReq})
        .then(res => {
            commit('getProductsLength', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}
