
require('./bootstrap');

window.Vue = require('vue');
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import Index from './Index'
Vue.component('app', Index)
Vue.component('font-awesome-icon', FontAwesomeIcon)
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faBars, faSearch, faTimes, faShoppingCart, faChevronRight, faChevronLeft, faAngleDoubleRight, faAngleDoubleLeft, faTrash, faPen, faSignOutAlt, faTimesCircle, faCheckCircle,faShippingFast, faMobileAlt, faMapMarkerAlt, faStoreAlt,faReceipt} from "@fortawesome/free-solid-svg-icons";
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import HomeAdmin from './pages/admin/Home'
import Login from './pages/admin/Login'
import AdminDashboard from './pages/admin/Dashboard'
import managementBrand from './pages/admin/ManagementBrand'
import managementSneakers from './pages/admin/ManagementSneakers'
import managementNews from './pages/admin/ManagementNews'
import Home from './pages/Home'
import Catalogue from './pages/Catalogue'
import Brand from './pages/Brand'
import Sneaker from './pages/Sneaker'
import ShoppingCart from './pages/ShoppingCart'
import Contact from './pages/Contact'
import New from './pages/New'
import News from './pages/News'
import Payment from './pages/Payment'
import Search from './pages/Search'
import Order from './pages/Order'
require('./store/subscriber')
library.add(faBars,faSearch, faTimes, faShoppingCart, faChevronRight,faChevronLeft,faAngleDoubleRight, faAngleDoubleLeft, faTrash,faPen, faSignOutAlt,faTimesCircle,faCheckCircle,faShippingFast,faMobileAlt,faMapMarkerAlt, faStoreAlt,faReceipt)
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
Vue.use(VueRouter)
import moment from 'moment'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.prototype.$moment = moment
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
            path: '/managementBrands',
            name: 'admin.brand',
            component: managementBrand,
        },
        {
            path: '/managementSneakers',
            name: 'admin.sneaker',
            component: managementSneakers,
        },
        {
            path: '/managementNews',
            name: 'admin.new',
            component: managementNews,
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
            path: '/products/search/:name',
            name: 'filteredProducts',
            component: Search,
        },
        {
            path: '/brand/:id',
            name: 'brand',
            component: Brand,
        },
        {
            path: '/products/:id',
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
            path: '/news/:id',
            name: 'new',
            component: New,
        },
        {
            path: '/news',
            name: 'news',
            component: News,
        },
        {
            path: '/payment/:id',
            name: 'payment',
            component: Payment,
        },
        {
            path: '/order/:id',
            name: 'order',
            component: Order,
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
