export const AddToBookmark = (state, product) => {
    state.bookmark.push(product)
    localStorage.setItem('bookmark', JSON.stringify(state.bookmark))
}

export const setBookmark = (state) => {
    state.bookmark = JSON.parse(localStorage.getItem('bookmark'))
}
