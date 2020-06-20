export const getUsers = (state, users) => {
    state.users = users
}

export const getUsersWithPaginate = (state, users) => {
    state.usersWithPaginate = users
}

export const getUser = (state, user) => {
    state.user = user
}

export const editUser = (state, user) => {
    let userInArray = state.usersWithPaginate.find(item => {
        return item.id === user.id
    })

    if (userInArray) {
        state.usersWithPaginate.forEach(item => {
            if (item.id === user.id) {
                item.lastname = user.lastname
                item.firstname = user.firstname
                item.email = user.email
                item.address = user.address
                item.city = user.city
                item.zipcode = user.zipcode
                item.additional_info = user.additional_info
                item.phone = user.phone
                item.is_admin = user.is_admin
            }
        })
    }
}

export const setUser = (state, user) => {
    state.users.push(user)
    state.usersWithPaginate.push(user)
}

export const getInfos = (state, infos) => {
    state.infos = infos
}

export const deleteUser = (state, response) => {
    state.users.splice(state.users.indexOf(response), 1)
    state.usersWithPaginate.splice(state.usersWithPaginate.indexOf(response), 1)
}

export const getUsersWithDate = (state, users) => {
    state.usersWithDate = users
}
