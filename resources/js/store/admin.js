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
    }
})