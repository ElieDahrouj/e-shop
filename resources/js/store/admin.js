import axios from 'axios'
import moment from "moment";
moment.locale('fr');
export default ({
    namespaced:true,
    state:{
        arrayBrands:[],
        arrayNews:[],
        arrayProducts:[],
        brandsSelect:[],
        msg:null,
        objectBrand:"",
        objectNew:"",
        objectProduct:""
    },
    getters: {
        getterArrayBrands(state){
            return state.arrayBrands
        },
        getterArrayNews(state){
            return state.arrayNews
        },
        getterArrayProducts(state){
            return state.arrayProducts
        },
        getterMsg(state){
            return state.msg
        },
        getterBrandsSelect(state){
            return state.brandsSelect
        },
        getterEditionBrand(state){
            return state.objectBrand
        },
        getterEditionNew(state){
            return state.objectNew
        },
        getterEditionProduct(state){
            return state.objectProduct
        }
    },
    mutations:{
        brandsToSelect(state,data){
            return state.brandsSelect = data
        },
        arrayDataBrands(state,data){
            return state.arrayBrands = data
        },
        arrayDataNews(state,data){
            return state.arrayNews = data
        },
        arrayDataProducts(state,data){
            state.arrayProducts = data
            state.arrayProducts.forEach(element => {
                element.release_date = moment(element.release_date).format("MMM Do YYYY");
            });
            return state.arrayProducts
        },
        msgToAlert(state,data){
            return state.msg = data
        },
        editionBrand(state,data) {
            return state.objectBrand = data
        },
        editionNew(state,data){
            return state.objectNew = data
        },
        editionProduct(state,data){
            return state.objectProduct = data
        }
    },
    actions: {
        adminBrand({commit}){
            axios.get("/api/brands")
                .then(response =>{
                    commit('arrayDataBrands',response.data.brands)
                })
        },
        adminNews({commit}){
            axios.get("/api/auth/adminNews")
                .then(response =>{
                    commit('arrayDataNews',response.data.news)
                })
        },
        adminProducts({commit}){
            axios.get("/api/auth/adminProducts")
                .then(response =>{
                    commit('arrayDataProducts',response.data.products)
                })
        },
        createBrand({commit,dispatch},object,config){
            axios.post('/api/auth/createBrand',object,config)
                .then( response => {
                    commit('msgToAlert',response.data)
                    dispatch('adminBrand')
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        },
        createNews({commit,dispatch},object,config){
            axios.post('/api/auth/createNews',object,config)
                .then( response => {
                    commit('msgToAlert',response.data)
                    dispatch('adminNews')
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        },
        async createSneaker({commit,dispatch},object,config){
            await axios.post('/api/auth/createSneakers',object,config)
                .then( response => {
                    commit('msgToAlert',response.data)
                    dispatch('adminProducts')
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        },
        displayBrandInSelect({commit}){
            axios.get("/api/brands")
                .then(response =>{
                    commit('brandsToSelect', response.data.brands)
                })
        },
        deleteNews({commit,dispatch},object){
            axios.delete('/api/auth/deleteNews/'+object)
                .then( response => {
                    commit('msgToAlert',response.data)
                    dispatch('adminNews')
                })
        },
        deleteBrand({commit,dispatch},object){
            axios.delete('/api/auth/deleteBrand/'+object)
                .then( response => {
                    commit('msgToAlert',response.data)
                    dispatch('adminBrand')
                })
        },
        deleteSneaker({commit,dispatch},object){
            axios.delete('/api/auth/deleteSneaker/'+object)
                .then( response => {
                    commit('msgToAlert',response.data)
                    dispatch('adminProducts')
                })
        },
        deleteSecondaryPicture({commit},object){
            axios.delete('/api/auth/deleteSecondaryPicture/'+object)
                .then(response =>{
                    commit('editionProduct',response.data.product)
                })
        },
        getOneBrand({commit},object){
            axios.get('/api/auth/displayBrand/'+object)
                .then( response => {
                    commit('editionBrand',response.data)
                })
        },
        getOneNew({commit},id){
            axios.get('/api/auth/displayNew/'+id)
                .then(response =>{
                    commit('editionNew',response.data)
                })
        },
        getOneProduct({commit},id){
            axios.get('/api/auth/displayProduct/'+id)
                .then(response =>{
                    commit('editionProduct',response.data)
                })
        },
        updateNew({commit,dispatch},configData){
            axios.request(configData)
                .then(response =>{
                    dispatch('adminNews')
                    commit('msgToAlert',response.data)
                    commit('editionNew',response.data.new)
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        },
        updateOneBrand({commit,dispatch},configData){
            axios.request(configData)
                .then(response => {
                    dispatch('adminBrand')
                    commit('msgToAlert',response.data)
                    commit('editionBrand',response.data.brand)
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        },
        updateOneProduct({commit,dispatch},configData){
            axios.request(configData)
                .then(response => {
                    dispatch('adminProducts')
                    commit('msgToAlert',response.data)
                    commit('editionProduct',response.data.product)
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        }
    }
})