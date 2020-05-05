const headersReq = {'Content-Type': 'multipart/form-data'}

export const getUsersWithPaginate = ({commit, dispatch}, {page, nb, orderBy}) => {
    if (nb == null || nb == undefined || nb == false) {
        nb = 10
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

export const getUsers = ({commit}) => {
    axios.get('/api/users', {headers: headersReq})
        .then(res => {
            commit('getUsers', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const deleteUser = ({commit}, id) => {
    axios.delete('/api/users/' + id, {headers: headersReq})
        .then(res => {
            if (res.data.status) {
                commit('deleteUser', res.data)
            }
        })
        .catch(err => {
            console.log(err)
        })
}
