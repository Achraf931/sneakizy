import {bus} from '../../../app.js'

const headersReq = {'Content-Type': 'multipart/form-data'}

export const createArticle = ({commit, dispatch}, form) => {
    axios.post(`/api/news`, form, {headers: {headersReq}})
        .then(res => {
            commit('addArticle', res.data)
            dispatch('notifications/AddNotification', {notification: "Article ajouté avec succès !", type: 1}, {root: true})
            dispatch('loader/OpenLoader', false, {root: true})
        })
        .catch(err => console.error(err))
}

export const editArticle = ({commit, dispatch}, {id, form}) => {
    axios.post(`/api/news/` + id, form, typeof form.is_published === 'undefined' ? {headers: headersReq} : '')
        .then(res => {
            commit('editArticle', res.data)
            dispatch('notifications/AddNotification', {notification: "Article modifié avec succès !", type: 1}, {root: true})
            dispatch('loader/OpenLoader', false, {root: true})
        })
        .catch(err => console.error(err))
}

export const getArticle = ({commit}, article) => {
    axios.get(`/api/news/${article}`, {headers: headersReq})
        .then(res => {
            commit('setArticle', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}

export const getArticles = ({commit}) => {
    axios.get('/api/news', {headers: headersReq})
        .then(res => {
            commit('getArticles', res.data)
        })
        .then(() => {
            bus.$emit('skeleton', false)
        })
        .catch(err => {
            console.log(err)
        })
}

export const getArticlesWithPaginate = ({commit, dispatch}, {page, nb, orderBy}) => {
    if (nb == null || nb == undefined || nb == false) {
        nb = 10
    }

    if (orderBy == null || orderBy == undefined || orderBy == false) {
        orderBy = 'ASC'
    }
    axios.get('/api/news?page=' + page + '&max=' + nb + '&orderBy=' + orderBy, {headers: headersReq})
        .then(res => {
            commit('getArticlesWithPaginate', res.data.data)
            commit('getInfos', res.data)
            dispatch('admin/verifyCheckPageChange', res.data.data, {root: true})
        })
        .catch(err => {
            console.log(err)
        })
}

export const deleteArticle = ({commit, dispatch}, id) => {
    axios.delete('/api/news/' + id, {headers: headersReq})
        .then(res => {
            if (res.data.status) {
                commit('deleteArticle', res.data)
                dispatch('notifications/AddNotification', {notification: "Article supprimé avec succès !", type: 1}, {root: true})
                dispatch('loader/OpenLoader', false, {root: true})
            }
        })
        .catch(err => {
            console.log(err)
        })
}
