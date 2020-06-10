export const AddNotification = ({commit}, {notification, type}) => {
    commit('AddNotification', {notification, type})
}

export const removeNotif = ({commit}, notification) => {
    commit('RemoveNotif', notification)
}
