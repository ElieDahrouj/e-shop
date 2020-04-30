
require('./bootstrap');

window.Vue = require('vue');
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import Index from './Index'
Vue.component('Navigation', require('./components/Navigation.vue').default);
Vue.component('index', Index)
Vue.component('font-awesome-icon', FontAwesomeIcon)
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faBars, faSearch, faTimes, faShoppingCart } from "@fortawesome/free-solid-svg-icons";
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import HomeAdmin from './pages/admin/Home'
import Login from './pages/admin/Login'
import AdminDashboard from './pages/admin/Dashboard'
import Home from './pages/Home'
import Catalogue from './pages/Catalogue'
import Brand from './pages/Brand'
import Sneaker from './pages/Sneaker'
import ShoppingCart from './pages/ShoppingCart'
import Contact from './pages/Contact'
import New from './pages/New'
import axios from 'axios'
require('./store/subscriber')
library.add(faBars,faSearch, faTimes, faShoppingCart)
Vue.prototype.$http = axios
Vue.use(VueRouter)
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path:'*',
            redirect:'/'
        },
        {
            path: '/homeAdmin',
            name: 'admin.home',
            component: HomeAdmin,
        },
        {
            path: '/login',
            name: 'admin.login',
            component: Login,
            meta:{
                requiresAuth : false
            }
        },
        {
            path: '/admin',
            name: 'admin.dashboard',
            component: AdminDashboard,
            meta:{
                requiresAuth : true
            }
        },
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/catalogue',
            name: 'catalogue',
            component: Catalogue,
        },
        {
            path: '/brand',
            name: 'brand',
            component: Brand,
        },
        {
            path: '/sneaker',
            name: 'sneaker',
            component: Sneaker,
        },
        {
            path: '/shopping',
            name: 'shoppingCart',
            component: ShoppingCart,
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact,
        },
        {
            path: '/new',
            name: 'new',
            component: New,
        },
    ],

});
router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(routes => routes.meta.requiresAuth)
    const currentUser = localStorage.getItem('token')
    if (requiresAuth && currentUser === null && to.path === '/admin' ) {
        next('/login')
    }
    else if (!requiresAuth && currentUser && (to.path === '/login' || to.path === '/homeAdmin')) {
        next('/admin')
    }
    else {
        next()
    }
});
store.dispatch('auth/attempt',localStorage.getItem('token'))
const app = new Vue({
    el: '#app',
    router,
    store
});
