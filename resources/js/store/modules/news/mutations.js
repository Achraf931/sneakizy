export const getArticles = (state, articles) => {
    state.articles = articles
}

export const getArticlesWithPaginate = (state, articles) => {
    state.articlesWithPaginate = articles
}

export const addArticle = (state, {article}) => {
    state.articles.unshift(article)
    state.articlesWithPaginate.unshift(article)
}

export const setArticle = (state, article) => {
    state.article = article
}

export const getInfos = (state, infos) => {
    state.infos = infos
}

export const deleteArticle = (state, response) => {
    state.articles.splice(state.articles.indexOf(response), 1)
    state.articlesWithPaginate.splice(state.articlesWithPaginate.indexOf(response), 1)
}
