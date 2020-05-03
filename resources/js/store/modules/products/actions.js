import {bus} from '../../../app'

const headersReq = {'Content-Type': 'multipart/form-data'}

export const addProduct = ({commit}, product) => {
    axios.post(`/api/products`, product, {headers: headersReq})
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

export const getProductsWithPaginate = ({commit, dispatch}, {page, nb}) => {
    if (nb == null || nb == undefined || nb == false) {
        nb = 8
    }
    axios.get('/api/products?page=' + page + '&max=' + nb, {headers: headersReq})
        .then(res => {
            commit('getProducts', res.data.data)
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
    axios.delete('/api/products/' + id)
        .then(res => {
            console.log('res actions')
            console.log(res)
            bus.$emit('eventVerifyCheckAll')
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
