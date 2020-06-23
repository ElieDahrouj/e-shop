import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import admin from './admin.js'
import cart from './cart.js'
import axios from 'axios'
import moment from 'moment';
Vue.use(Vuex)

export default new Vuex.Store({
    state:{
        arrayNews: [],
        arrayProducts: [],
        oneObject:{},
        dateTimeProduct:null,
        arrayBrands:[],
        searchData:null,
        msgContact:null,
        statusLoaderContact:false
    },
    getters:{
        dataProducts(state){
            return state.arrayProducts
        },
        oneDataProduct(state){
            return state.oneObject
        },
        dateOneProduct(state){
          return state.dateTimeProduct
        },
        getterNews(state){
            return state.arrayNews
        },
        getterBrands(state){
            return state.arrayBrands
        },
        getterMsg(state){
            return state.msgContact
        },
        getterloaderContact(state){
            return state.statusLoaderContact
        }
    },
    mutations:{
        dataOneProduct(state, data){
            state.oneObject = data
        },
        dateOneProduct(state,data){
            state.dateTimeProduct = moment(data).locale('fr').format('L')
        },
        displayAllNews(state,data){
            state.arrayNews = data.news
        },
        allProducts(state,data){
            state.arrayProducts = data
        },
        allBrands(state,data){
            state.arrayBrands = data
        },
        searchData(state,data){
            state.searchData = data
        },
        sendMessage(state,data){
            state.msgContact = data
        },
        loaderContact(state,data){
            state.statusLoaderContact = data
        }
    },
    actions:{
        configDate({commit},date){
            commit('dateOneProduct',date)
        },
        homePage({commit}) {
            axios.get("/api/products?sort=random&max=10")
                .then(response => {
                    commit('allProducts',response.data.products)
                })
                .then(()=>{
                    axios.get("/api/fiveNews")
                        .then(response => {
                            commit('displayAllNews',response.data)
                        })
                })
        },
        sneaker({commit, dispatch}, id){
          axios.get("/api/product/"+id)
              .then(response =>{
                  commit('dataOneProduct',response.data.product)
                  dispatch('configDate',response.data.product.release_date)
              })
        },
        allNews({commit}){
            axios.get("/api/news")
                .then(response =>{
                    commit('displayAllNews',response.data)
                })
        },
        oneNew({commit},id){
            axios.get("/api/news/"+id)
                .then(response =>{
                    commit('dataOneProduct',response.data.new)
                })
        },
        allProducts({commit}){
            axios.get("/api/products")
                .then(response =>{
                    commit('allProducts',response.data.products)
                    commit('allBrands',response.data.brands)
                })
                .then(()=>{
                    axios.get("/api/brands")
                        .then(response => {
                            commit('allBrands',response.data.brands)
                        })
                })
        },
        allProductsByBrand({commit},id){
            axios.get("/api/brands/"+id+"/products")
                .then(response =>{
                    commit('allBrands',response.data.brand)
                })
        },
        searchProducts({commit},nameData){
            axios.get("/api/products?search="+nameData)
                .then(response => {
                    commit('allProducts',response.data.products.data)
                    commit('dataOneProduct',response.data.products)
                    commit('searchData',nameData)
                })
        },
        paginationPage({commit,state},page){
            axios.get("/api/products?page="+page+"&search="+state.searchData)
                .then(response => {
                    commit('allProducts',response.data.products.data)
                    commit('dataOneProduct',response.data.products)
                });
        },
        sendMessageFromContact({commit},object){
            commit('loaderContact', true)
            axios.post("/api/contact",{firstName:object.firstName, lastName : object.lastName,
                mail:object.mail, subject:object.subject, message:object.message} )
                .then(response =>{
                    commit('loaderContact', false)
                    commit('sendMessage',response.data)
                    setTimeout(()=>{
                        commit('sendMessage',null)
                    },2500)
                })
        }
    },
    modules:{
        auth,
        admin,
        cart
    }
})