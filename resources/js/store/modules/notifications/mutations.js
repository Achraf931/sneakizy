export const AddNotification = (state, notification) => {
    state.notification = notification
    setTimeout(() => {
        state.notification = {}
    }, 5000)
}
