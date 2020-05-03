const headersReq = {'Content-Type': 'multipart/form-data'}

export const getBrands = ({commit}) => {
    axios.get('/api/brands', {headers: headersReq})
        .then(res => {
            commit('getBrands', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const getBrandsWithPaginate = ({commit, dispatch}, {page, nb}) => {
    axios.get('/api/brands?page=' + page + '&max=' + nb, {headers: headersReq})
        .then(res => {
            commit('getBrands', res.data.data)
            commit('getInfos', res.data)
            dispatch('admin/verifyCheckPageChange', res.data.data, {root: true})
        })
        .catch(err => {
            console.log(err)
        })
}
