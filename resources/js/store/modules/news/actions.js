const headersReq = {'Content-Type': 'multipart/form-data'}

export const addArticle = ({commit}, article) => {
    axios.post(`/api/news`, article, {headers: {headersReq}})
        .then(res => {
            commit('addArticle', res.data)
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
            commit('getArticles', res.data.data)
            commit('getInfos', res.data)
            dispatch('admin/verifyCheckPageChange', res.data.data, {root: true})
        })
        .catch(err => {
            console.log(err)
        })
}