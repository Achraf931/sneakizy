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

export const getProducts = ({commit}, page) => {
    axios.get('/api/products?page=' + page, {headers: headersReq})
        .then(res => {
            commit('getProducts', res.data.data)
            commit('getInfos', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const getBrandProducts = ({commit}, {id, page}) => {
    axios.get('/api/brands/' + id + '/products?page=' + page, {headers: headersReq})
        .then(res => {
            commit('getProducts', res.data.data)
            commit('getInfos', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}
