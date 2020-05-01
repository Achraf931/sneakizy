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
