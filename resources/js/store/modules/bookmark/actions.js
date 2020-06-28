export const AddProductToBookmark = ({commit}, product) => {
    commit('AddToBookmark', product)
}

export const getBookmark = ({commit}) => {
    commit('setBookmark')
}
