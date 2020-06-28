export default {
    bookmark: JSON.parse(localStorage.getItem('bookmark')) !== null ? JSON.parse(localStorage.getItem('bookmark')) : []
}
