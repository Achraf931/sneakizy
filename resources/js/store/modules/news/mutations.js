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

export const editArticle = (state, article) => {
    let articleInArray = state.articlesWithPaginate.find(item => {
        return item.id === article.id
    })

    if (articleInArray) {
        state.articlesWithPaginate.forEach(item => {
            if (item.id === article.id) {
                item.is_published = article.is_published
                item.title = article.title
                item.summary = article.summary
                item.content = article.content
                item.author = article.author
                item.image = article.image
                item.banner = article.banner
            }
        })
    }
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
