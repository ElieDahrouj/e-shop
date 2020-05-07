import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import axios from 'axios'
import moment from 'moment';
Vue.use(Vuex)

export default new Vuex.Store({
    state:{
        fiveNews: [],
        tenProductRandom: [],
        oneProduct:{},
        dateTimeProduct:null,
        pictureOneProduct:[]
    },
    getters:{
        fiveDataNews(state){
            return state.fiveNews
        },
        tenDataRandom(state){
            return state.tenProductRandom
        },
        oneDataProduct(state){
            return state.oneProduct
        },
        dateOneProduct(state){
          return state.dateTimeProduct
        },
        pictureDataProduct(state){
            return state.pictureOneProduct
        },
    },
    mutations:{
        dataHomePage(state,data){
            state.fiveNews = data.news
            state.tenProductRandom = data.products
        },
        dataOneProduct(state, data){
            state.oneProduct = data.product
            state.pictureOneProduct = data.images
        },
        dateOneProduct(state,data){
            state.dateTimeProduct = moment(data).format('L')
        }
    },
    actions:{
        configDateTime(date) {
            return moment(date).format('L')
        },
        configDateOneProduct({commit},date){
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
                  commit('dataOneProduct',response.data)
                  dispatch('configDateOneProduct',response.data.product.release_date)
              })
        }

    },
    modules:{
        auth
    }
})