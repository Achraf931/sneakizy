export const toggleCheckAll = ({commit}, {items, event}) => {
    commit('toggleCheckAll', {items, event})
}

export const checked = ({commit}, id) => {
    commit('checked', id)
}

export const verifyCheckPageChange = ({commit}, items) => {
    commit('verifyCheckPageChange', items)
}

export const deleteItem = ({commit}) => {
    commit('deleteItem')
}
