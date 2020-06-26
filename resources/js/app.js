require('./bootstrap');
import store from './store/index'
window.Vue = require('vue');
import VueRouter from 'vue-router'
import App from './views/App'
import Home from './views/Home'
import Login from './views/Login'
import Register from './views/Register'

import Admin from './views/Admin'
import MainAdmin from './components/admin/Main'
import UsersAdmin from './components/admin/Users'
import ProductsAdmin from './components/admin/Products'
import OrdersAdmin from './components/admin/Orders'
import BrandsAdmin from './components/admin/Brands'
import NewsAdmin from './components/admin/News'
import SearchingPage from "./views/SearchingPage"

import Basket from './views/Basket'
import Checkout from './views/Checkout'
import Recap from './views/Recap'


import UserBoard from './views/UserBoard'
import Product from './views/SingleProduct'
import Catalog from './views/Catalog'
import News from './views/News'
import SingleArticle from './views/SingleArticle'
import Contact from './views/Contact'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faTimes, faBars, faShoppingBasket, faSearch, faTruck, faStopwatch, faLock, faHeart, faAngleRight, faAngleDoubleRight, faAngleLeft, faAngleDoubleLeft, faEllipsisH, faPlus, faTrashAlt } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import vuelidate from 'vuelidate'
import VueCarousel from 'vue-carousel'

library.add(faTimes, faBars, faShoppingBasket, faSearch, faTruck, faStopwatch, faLock, faHeart, faAngleRight, faAngleDoubleRight, faAngleLeft, faAngleDoubleLeft, faEllipsisH, faPlus, faTrashAlt)

export const bus = new Vue()
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.use(VueRouter)
Vue.use(vuelidate)
Vue.use(VueCarousel)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                title: 'Accueil'
            }
        },
        {
            path: '/catalog',
            name: 'catalog',
            component: Catalog,
            meta: {
                title: 'Catalogue'
            }
        },
        {
            path: '/search',
            name: 'searchingPage',
            component: SearchingPage,
            meta: {
                title: 'Recherche'
            }
        },
        {
            path: '/brands/:id/products',
            name: 'brandProducts',
            component: Catalog,
            props: true,
            meta: {
                title: 'Catalogue'
            }
        },
        {
            path: '/news',
            name: 'news',
            component: News,
            meta: {
                title: 'News'
            }
        },
        {
            path: '/news/:id',
            name: 'singleArticle',
            component: SingleArticle
        },
        {
            path: '/products/:id',
            name: 'product',
            component: Product
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact,
            meta: {
                title: 'Contact'
            }
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
            path: '/checkout',
            name: 'checkout',
            component: Checkout,
            meta: {
                title: 'Checkout'
            }
        },
        {
            path: '/recap',
            name: 'recap',
            component: Recap,
            meta: {
                title: 'Récapitulatif de commande'
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
            path: '/admin',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin : true,
                title: 'Admin'
            },
            children: [
                {
                    path: '/',
                    name: 'main',
                    component: MainAdmin,
                },
                {
                    path: 'users',
                    name: 'admin/users',
                    component: UsersAdmin,
                },
                {
                    path: 'products',
                    name: 'admin/products',
                    component: ProductsAdmin,
                },
                {
                    path: 'orders',
                    name: 'admin/orders',
                    component: OrdersAdmin,
                },
                {
                    path: 'brands',
                    name: 'admin/brands',
                    component: BrandsAdmin,
                },
                {
                    path: 'news',
                    name: 'admin/news',
                    component: NewsAdmin,
                },
                {
                    path: '*',
                    redirect: 'main'
                }
            ]
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
                    store.commit('admin/removeAllSelected')
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
