import moment from "moment";
import axios from "axios"
moment.locale('fr');
export default ({
    namespaced:true,
    state:{
        displayArray:'',
        arrayLength:null,
        totalPrice:0,
    },
    getters: {
        getterCart(state){
            return state.displayArray
        },
        getterCartLength(state){
            return state.arrayLength
        },
        getterTotalPrice(state){
            return state.totalPrice
        }
    },
    mutations:{
        displayCart(state,data){
            return state.displayArray = data
        },
        lengthArray(state,data){
            if (data !==null)
            return state.arrayLength = data.basket.length
        },
        changeQuantity(state,data){
            let cart = JSON.parse(localStorage.getItem("basketful"))
            cart.basket.forEach(element =>{
                if (element.id === data.id){
                    element.quantity += data.newQuantity
                }
            })
            localStorage.setItem("basketful",JSON.stringify(cart))
        },
        calculPrice(state,data){
            state.totalPrice = 0
            data.basket.forEach(element =>{
                return state.totalPrice += (element.product.price * element.quantity)
            })
        },
    },
    actions: {
        getCart({commit}){
            if (localStorage.getItem("basketful")) {
                if (localStorage.getItem("basketful").basket !== 0){
                    commit('displayCart',JSON.parse(localStorage.getItem("basketful")))
                    commit('lengthArray',JSON.parse(localStorage.getItem("basketful")))
                    commit('calculPrice',JSON.parse(localStorage.getItem("basketful")))
                }
            }
            else{
                commit('displayCart',"")
                commit('lengthArray',null)
            }
        },
        modifyQuantity({commit},object) {
            if (localStorage.getItem("basketful")) {
                if (localStorage.getItem("basketful").basket !== 0){
                    commit('changeQuantity',object)
                }
            }
        },
        async confirmOrder({commit,state},info){
            await axios.post("/api/order",{first_name:info.infoCustomer.firstname,last_name:info.infoCustomer.lastName,address:info.infoCustomer.address,
                zipcode:info.infoCustomer.postcode,city:info.infoCustomer.city,email:info.infoCustomer.mail,phone_number:info.infoCustomer.phoneNumber,basketful:JSON.parse(localStorage.getItem("basketful")),
                cvc:info.infoCBcart.cartCVC,month:info.infoCBcart.month,year:info.infoCBcart.year,cartNumber:info.infoCBcart.cartNumber})
                .then(() =>{
                    console.log("confirm")
                    return state.arrayLength = 0
                })
        },
    }
})