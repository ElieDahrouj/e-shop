import axios from 'axios'
export default ({
    namespaced:true,
    state:{
        arrayAllData:[]
    },
    getters: {
        getterArray(state){
            return state.arrayAllData
        }
    },
    mutations:{
        arrayData(state,data){
            return state.arrayAllData = data
        }
    },
    actions: {
        adminBrand({commit}){
            axios.get("/api/brands")
                .then(response =>{
                    console.log(response.data)
                    commit('arrayData',response.data.brands)
                })
        },
        adminNews({commit}){
            axios.get("/api/auth/adminNews")
                .then(response =>{
                    commit('arrayData',response.data.news)
                })
        },
        adminProducts({commit}){
            axios.get("/api/auth/adminProducts")
                .then(response =>{
                    commit('arrayData',response.data.products)
                })
        },
    }
})