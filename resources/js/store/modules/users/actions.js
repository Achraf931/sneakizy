const headersReq = {'Content-Type': 'multipart/form-data'}

export const getUsers = ({commit, dispatch}, {page, nb, orderBy}) => {
    if (nb == null || nb == undefined || nb == false) {
        nb = 8
    }

    if (orderBy == null || orderBy == undefined || orderBy == false) {
        orderBy = 'ASC'
    }

    axios.get('/api/users?page=' + page + '&max=' + nb + '&orderBy=' + orderBy, {headers: headersReq})
        .then(res => {
            commit('getUsers', res.data.data)
            commit('getInfos', res.data)
            dispatch('admin/verifyCheckPageChange', res.data.data, {root: true})
        })
        .catch(err => {
            console.log(err)
        })
}
