export default {
    basket: JSON.parse(localStorage.getItem('basket')) !== null ? JSON.parse(localStorage.getItem('basket')) : []
}
