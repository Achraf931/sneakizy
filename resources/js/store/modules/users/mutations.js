export const getUsers = (state, users) => {
    state.users = users
}

export const getInfos = (state, infos) => {
    state.infos = infos
}

export const deleteUser = (state, response) => {
    state.users.splice(state.users.indexOf(response), 1)
}
