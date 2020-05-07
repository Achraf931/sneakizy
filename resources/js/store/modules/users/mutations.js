export const getUsers = (state, users) => {
    state.users = users
}

export const getUsersWithPaginate = (state, users) => {
    state.usersWithPaginate = users
}

export const getUser = (state, user) => {
    state.user = user
}
export const getInfos = (state, infos) => {
    state.infos = infos
}

export const deleteUser = (state, response) => {
    state.users.splice(state.users.indexOf(response), 1)
}

export const getUsersWithDate = (state, users) => {
    state.usersWithDate = users
}
