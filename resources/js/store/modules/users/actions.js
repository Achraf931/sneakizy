const headersReq = {'Content-Type': 'multipart/form-data'}

export const getUsers = ({commit}) => {
    axios.get('/api/users', {headers: headersReq})
        .then(res => {
            commit('getUsers', res.data)
        })
        .catch(err => {
            console.log(err)
        })
}
