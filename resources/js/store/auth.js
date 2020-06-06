import axios from 'axios'
export default ({
    namespaced:true,
    state:{
        token:null,
        user:null
    },
    getters: {
        authentificated(state) {
            return state.token && state.user
        },
        user(state) {
            return state.user
        },
    },
    mutations:{
        set_token(state, token ){
            state.token = token
        },
        set_user(state, user ){
            state.user = user
        }
    },
    actions:{
        async login({dispatch}, credentials){
            await axios.post('/api/auth/signin', credentials)
                .then(response =>{
                    return dispatch('attempt',response.data.token)
                })
        },
        async attempt({commit,state}, token){
            if (token) {
                commit('set_token', token)
            }
            if (state.token !== null) {
                try {
                    await axios.get('/api/auth/me')
                        .then(response => {
                            commit('set_user', response.data)
                        })
                }
                catch (e) {
                    commit('set_token', null)
                    commit('set_user', null)
                }
            }
        },
        signOut({commit}){
            return axios.post("/api/auth/signout")
                .then(()=>{
                    commit('set_token', null)
                    commit('set_user', null)
                })
        }
    },
})