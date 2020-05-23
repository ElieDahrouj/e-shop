import axios from 'axios'
export default ({
    namespaced:true,
    state:{
        brands:[]
    },
    getters: {
        getterArrayBrands(state){
            return state.brands
        }
    },
    mutations:{
        arrayBrand(state,data){
            return state.brands = data
        }
    },
    actions: {
        adminBrand({commit}){
            axios.get("/api/brands")
                .then(response =>{
                    console.log(response.data)
                    commit('arrayBrand',response.data.brands)
                })
        }
    }
})