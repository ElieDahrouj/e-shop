import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import axios from 'axios'
import moment from 'moment';
Vue.use(Vuex)

export default new Vuex.Store({
    state:{
        arrayNews: [],
        tenProductRandom: [],
        oneObject:{},
        dateTimeProduct:null,
    },
    getters:{
        tenDataRandom(state){
            return state.tenProductRandom
        },
        oneDataProduct(state){
            return state.oneObject
        },
        dateOneProduct(state){
          return state.dateTimeProduct
        },
        getterNews(state){
            return state.arrayNews
        }
    },
    mutations:{
        dataHomePage(state,data){
            state.arrayNews = data.news
            state.tenProductRandom = data.products
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
                    console.log(response.data)
                    commit('displayAllNews',response.data)
                })
        },
        oneNew({commit},id){
            axios.get("/api/news/"+id)
                .then(response =>{
                    console.log(response.data)
                    commit('dataOneProduct',response.data.new)
                })
        }

    },
    modules:{
        auth
    }
})