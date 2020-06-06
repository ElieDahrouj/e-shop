import store from '../store'
import axios from 'axios'
store.subscribe((mutation)=>{
    if(mutation.type) {
        if (mutation.type === 'auth/set_token'){
            if (mutation.payload) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
                localStorage.setItem('token', mutation.payload)
            }
            else {
                axios.defaults.headers.common['Authorization'] = null
                localStorage.removeItem('token')
                localStorage.removeItem('user')
            }
        }
        else if(mutation.type === 'auth/set_user'){
            if (mutation.payload) {
                if (!localStorage.getItem('user'))
                localStorage.setItem('user', JSON.stringify(mutation.payload))
            }
        }
    }
})