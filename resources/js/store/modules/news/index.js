export default {
    namespaced: true,
    state: {
        articles: [],
        article: {}
    },
    getters: {
        articles: state => {
            return state.articles
        },
        article: state => {
            return state.article
        }
    },
    mutations: {
        getArticles(state, articles) {
            state.articles = articles
        },
        addArticle(state, {articles}) {
            state.articles.unshift(articles)
        },
        setArticle(state, article) {
            state.article = article
        }
    },
    actions: {
        addArticle({commit}, article) {
            axios.post(`/api/news`, article, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    {
                        commit('addArticle', res.data)
                    }
                })
                .catch(err => console.error(err))
        },

        getArticles({commit}) {
            axios.get('/api/news')
                .then(res => {
                    {
                        commit('getArticles', res.data)
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        },

        getArticle({commit}, article) {
            axios.get(`/api/news/${article}`)
                .then(res => {
                    {
                        commit('setArticle', res.data)
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
