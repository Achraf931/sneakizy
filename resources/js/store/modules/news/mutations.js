export const getArticles = (state, articles) => {
    state.articles = articles
}

export const addArticle = (state, {article}) => {
    state.articles.unshift(article)
}

export const setArticle = (state, article) => {
    state.article = article
}

export const getInfos = (state, infos) => {
    state.infos = infos
}
