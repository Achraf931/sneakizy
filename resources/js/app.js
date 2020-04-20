require('./bootstrap');
import store from './store/index'
window.Vue = require('vue');
import VueRouter from 'vue-router'
import App from './views/App'
import Home from './views/Home'
import Login from './views/Login'
import Register from './views/Register'
import Admin from './views/Admin'
import Basket from './views/Basket'
import UserBoard from './views/UserBoard'
import Sneaker from './views/SingleSneaker'
import Catalog from './views/Catalog'
import News from './views/News'
import Contact from './views/Contact'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faTimes, faBars, faShoppingBasket } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faTimes, faBars, faShoppingBasket)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/catalog',
            name: 'catalog',
            component: Catalog
        },
        {
            path: '/news',
            name: 'news',
            component: News
        },
        {
            path: '/sneakers/:id',
            name: 'sneaker',
            component: Sneaker
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                requiresAuth: false,
                is_user : true,
                title: 'Login'
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                requiresAuth: false,
                is_user : true,
                title: 'Register'
            }
        },
        {
            path: '/basket',
            name: 'basket',
            component: Basket,
            meta: {
                title: 'Panier'
            }
        },
        {
            path: '/dashboard',
            name: 'userboard',
            component: UserBoard,
            meta: {
                requiresAuth: true,
                is_user : true,
                title: 'Profil'
            }
        },
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin : true
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin : true,
                title: 'Admin'
            }
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
})


router.beforeEach((to, from, next) => {
    document.title = to.meta.title || 'Sneakizy'
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('jwt') == null) {
            next({
                path: '/login',
                params: { nextUrl: to.fullPath }
            })
        } else {
            let user = JSON.parse(localStorage.getItem('user'))
            if(to.matched.some(record => record.meta.is_admin)) {
                if(user.is_admin){
                    next()
                }
                else{
                    next({ name: 'userboard'})
                }
            }
            else if(to.matched.some(record => record.meta.is_user)) {
                if(!user.is_admin){
                    next()
                }
                else{
                    next({ name: 'admin'})
                }
            }
            next()
        }
    } else {
        next()
    }
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
