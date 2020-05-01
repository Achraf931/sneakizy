export const fetchUser = ({commit}, user) => {
    if (user) {
        commit('setLoggedIn', true)
        commit('setUser', {
            displayName: user.displayName,
            email: user.email
        })
        return
    }

    commit('setLoggedIn', false)
    commit('setUser', null)
}
