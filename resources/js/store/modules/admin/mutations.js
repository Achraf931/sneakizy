export const toggleCheckAll = (state, {items, event}) => {
    items.forEach(item => {
        if (event) {
            if (state.itemsChecked.indexOf(item.id) === -1) {
                state.itemsChecked.push(item.id)
            }
            return
        }

        state.itemsChecked.splice(state.itemsChecked.indexOf(item.id), 1)
    })

    state.checkedAll = !!event;
}

export const checked = (state, id) => {
    if (state.itemsChecked.indexOf(id) === -1) {
        state.itemsChecked.push(id)
        return
    }
    state.itemsChecked.splice(state.itemsChecked.indexOf(id), 1)
}

export const verifyCheckPageChange = (state, items) => {
    let i = 0

    items.forEach(item => {
        i++

        if (i === state.itemsChecked.length) {
            state.checkedAll = true
        }
        state.checkedAll = state.itemsChecked.indexOf(item.id) !== -1
    })
}
