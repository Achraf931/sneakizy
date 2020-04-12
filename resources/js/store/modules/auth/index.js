export default {
    namespaced: true,
    state: {
        user: {
            loggedIn: false,
            data: null
        }
    },
    getters: {
        user(state) {
            return state.user
        }
    },
    mutations: {
        setLoggedIn(state, value) {
            state.user.loggedIn = value
        },
        setUser(state, data) {
            if (data)
                return state.user.data = data

            state.user.data = null
        }
    },
    actions: {
        fetchUser({ commit }, user) {
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
    }
}
