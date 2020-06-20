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
            commit('getUsersWithPaginate', res.data.data)
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

export const getUsersWithDate = ({commit}, date) => {
    let url
    if (date.today) {
        url = '/api/users?date=' + date.today
    }
    else {
        url = '/api/users?start=' + date.start + '&end=' + date.end
    }
    axios.get(url, {headers: headersReq})
        .then(res => {
            commit('getUsersWithDate', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const getUser = ({commit}, id) => {
    axios.get('/api/users/' + id, {headers: headersReq})
        .then(res => {
            commit('getUser', res.data)
        })
}

export const editUser = ({commit, dispatch}, {id, form}) => {
    axios.patch('/api/users/' + id, form.form)
        .then(res => {
            commit('editUser', res.data)
            dispatch('notifications/AddNotification', {notification: "Utilisateur modifié avec succès !", type: 1}, {root: true})
            dispatch('loader/OpenLoader', false, {root: true})
        })
}

export const deleteUser = ({commit, dispatch}, id) => {
    axios.delete('/api/users/' + id, {headers: headersReq})
        .then(res => {
            commit('deleteUser', res.data)
            dispatch('notifications/AddNotification', {notification: "Utilisateur supprimé avec succès !", type: 1}, {root: true})
            dispatch('loader/OpenLoader', false, {root: true})
        })
        .catch(err => {
            console.log(err)
        })
}

export const createUser = ({commit, dispatch}, form) => {
    axios.post('/api/users', form.form)
        .then(res => {
            commit('setUser', res.data)
            dispatch('notifications/AddNotification', {notification: "Utilisateur ajouté avec succès !", type: 1}, {root: true})
            dispatch('loader/OpenLoader', false, {root: true})
        })
        .catch(err => {
            console.log(err)
        })
}
