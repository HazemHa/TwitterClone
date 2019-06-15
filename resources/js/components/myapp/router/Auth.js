export default (to, from, next) => {
    // check if user Auth continu request
    // else convert to login page. .
    // it is like middleware for specific component
    if (Vue.prototype.$authLaravel.isAuth()) {
        next()
    } else {
        next('/login')
    }
}
