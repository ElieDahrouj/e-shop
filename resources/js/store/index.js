import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import axios from 'axios'
import moment from 'moment';
Vue.use(Vuex)

export default new Vuex.Store({
    state:{
        arrayNews: [],
        arrayProducts: [],
        oneObject:{},
        dateTimeProduct:null,
        arrayBrands:[]
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
        }
    },
    mutations:{
        dataHomePage(state,data){
            state.arrayNews = data.news
            state.arrayProducts = data.products
        },
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
    },
    actions:{
        configDate({commit},date){
            commit('dateOneProduct',date)
        },
        homePage({commit}) {
            axios.get("/api")
                .then(response => {
                    commit('dataHomePage',response.data)
                })
        },
        sneaker({commit, dispatch}, id){
          axios.get("/api/"+id+"/product")
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
            axios.get("/api/catalogue")
                .then(response =>{
                    commit('allProducts',response.data.products)
                    commit('allBrands',response.data.brands)
                })
        }

    },
    modules:{
        auth
    }
})