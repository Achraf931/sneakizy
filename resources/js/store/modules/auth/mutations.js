export const setLoggedIn = (state, value) => {
    state.user.loggedIn = value
}

export const setUser = (state, data) => {
    if (data)
        console.log(data)
        return state.user.data = data

    state.user.data = null
}
