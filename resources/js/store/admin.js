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
        objectProduct:"",
        loaderSneaker:false,
        loaderUpdateNew:false,
        loaderUpdateBrand:false,
        createProduct:false,
        createNew:false,
        createNewBrand:false,
        loaderDeleteProduct:false,
        idProductDelete:null,
        loaderDeleteNew:false,
        idNewDelete:null,
        loaderDeleteBrand:false,
        idBrandDelete:null,
        loaderDeletePicture:false,
        idPictureDelete:null
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
        },
        getterLoaderProduct(state){
            return state.loaderSneaker
        },
        getterLoaderUpdateNew(state){
            return state.loaderUpdateNew
        },
        getterLoaderUpdateBrand(state){
            return state.loaderUpdateBrand
        },
        getterCreateLoaderProduct(state){
            return state.createProduct
        },
        getterCreateLoaderNew(state){
            return state.createNew
        },
        getterCreateLoaderBrand(state){
            return state.createNewBrand
        },
        getterDeleteLoaderProduct(state){
            return state.loaderDeleteProduct
        },
        getterIdProductLoader(state){
            return state.idProductDelete
        },
        getterDeleteLoaderNew(state){
            return state.loaderDeleteNew
        },
        getterIdNewLoader(state){
            return state.idNewDelete
        },
        getterDeleteLoaderBrand(state){
            return state.loaderDeleteBrand
        },
        getterIdBrandLoader(state){
            return state.idBrandDelete
        },
        getterDeleteLoaderPicture(state){
            return state.loaderDeletePicture
        },
        getterIdPictureLoader(state){
            return state.idPictureDelete
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
        },
        loaderProduct(state,data){
            return state.loaderSneaker = data
        },
        loaderNew(state,data){
            return state.loaderUpdateNew = data
        },
        loaderBrand(state,data){
          return state.loaderUpdateBrand = data
        },
        loaderCreateProduct(state,data){
            return state.createProduct = data
        },
        loaderCreateNew(state,data){
            return state.createNew = data
        },
        loaderCreateBrand(state,data){
            return state.createNewBrand = data
        },
        deleteProductLoader(state,data){
            return state.loaderDeleteProduct = data
        },
        idDeleteProductLoader(state,data){
            return state.idProductDelete = data
        },
        deleteNewLoader(state,data){
            return state.loaderDeleteNew = data
        },
        idDeleteNewLoader(state,data){
            return state.idNewDelete = data
        },
        deleteBrandLoader(state,data){
            return state.loaderDeleteBrand = data
        },
        idDeleteBrandLoader(state,data){
            return state.idBrandDelete = data
        },
        deletePictureLoader(state,data){
            return state.loaderDeletePicture = data
        },
        idDeletePictureLoader(state,data){
            return state.idPictureDelete = data
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
        async createBrand({commit,dispatch},object,config){
            commit('loaderCreateBrand',true)
            await axios.post('/api/auth/createBrand',object,config)
                .then( response => {
                    commit('loaderCreateBrand',false)
                    commit('msgToAlert',response.data)
                    dispatch('adminBrand')
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        },
        async createNews({commit,dispatch},object,config){
            commit('loaderCreateNew',true)
            await axios.post('/api/auth/createNews',object,config)
                .then( response => {
                    commit('loaderCreateNew',false)
                    commit('msgToAlert',response.data)
                    dispatch('adminNews')
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        },
        async createSneaker({commit,dispatch},object,config){
            commit('loaderCreateProduct',true)
            await axios.post('/api/auth/createSneakers',object,config)
                .then( response => {
                    commit('loaderCreateProduct',false)
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
            commit('deleteNewLoader', true)
            commit('idDeleteNewLoader', object)
            axios.delete('/api/auth/deleteNews/'+object)
                .then( response => {
                    commit('msgToAlert',response.data)
                    commit('deleteProductLoader', false)
                    commit('idDeleteProductLoader', null)
                    dispatch('adminNews')
                })
        },
        deleteBrand({commit,dispatch},object){
            commit('deleteBrandLoader', true)
            commit('idDeleteBrandLoader', object)
            axios.delete('/api/auth/deleteBrand/'+object)
                .then( response => {
                    commit('msgToAlert',response.data)
                    commit('deleteBrandLoader', false)
                    commit('idDeleteBrandLoader', null)
                    dispatch('adminBrand')
                })
        },
        deleteSneaker({commit,dispatch},object){
            commit('deleteProductLoader', true)
            commit('idDeleteProductLoader', object)
            axios.delete('/api/auth/deleteSneaker/'+object)
                .then( response => {
                    commit('msgToAlert',response.data)
                    commit('deleteProductLoader', false)
                    commit('idDeleteProductLoader', null)
                    dispatch('adminProducts')
                })
        },
        deleteSecondaryPicture({commit},object){
            commit('deletePictureLoader', true)
            commit('idDeletePictureLoader', object)
            axios.delete('/api/auth/deleteSecondaryPicture/'+object)
                .then(response =>{
                    commit('editionProduct',response.data.product)
                    commit('deletePictureLoader', false)
                    commit('idDeletePictureLoader', null)
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
        async updateNew({commit,dispatch},configData){
            commit('loaderNew',true)
            await axios.request(configData)
                .then(response =>{
                    commit('loaderNew',false)
                    dispatch('adminNews')
                    commit('msgToAlert',response.data)
                    commit('editionNew',response.data.new)
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        },
        async updateOneBrand({commit,dispatch},configData){
            commit('loaderBrand',true)
            await axios.request(configData)
                .then(response => {
                    commit('loaderBrand',false)
                    dispatch('adminBrand')
                    commit('msgToAlert',response.data)
                    commit('editionBrand',response.data.brand)
                    setTimeout(() =>{
                        commit('msgToAlert',null)
                    },3500)
                })
        },
        async updateOneProduct({commit,dispatch},configData){
            commit('loaderProduct',true)
            await axios.request(configData)
                .then(response => {
                    commit('loaderProduct',false)
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