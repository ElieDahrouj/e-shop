<template>
    <div>
        <publicNav></publicNav>
        <h4><b>Panier</b></h4>
        <section class="shoppingCart">
            <div v-if="this.getterCart" class="cart">
                <transition name="fade">
                    <div v-for="(cartProduct,index) in getterCart.basket" :key="index" class="product">
                        <div class="picture">
                            <img :src="cartProduct.product.image" alt="">
                        </div>
                        <div class="infoProduct">
                            <div class="firstName">
                                <p> <router-link :to="{ name: 'sneaker', params: { id: cartProduct.product.id }}">{{cartProduct.product.name}} </router-link></p>
                                <p><b>Prix : </b>{{cartProduct.product.price}} €</p>
                            </div>
                            <p><b>Coloris : </b> {{cartProduct.product.color}}</p>
                            <p><b>Taille : </b> {{cartProduct.size}} EU</p>
                            <p><b>Quantité actuelle : </b> {{cartProduct.quantity}}</p>
                            <div class="secondName w-100 d-flex justify-content-between align-items-end">
                                <div class="d-flex flex-column align-items-start">
                                    <label for="quandtity">Quantité désirée</label>
                                    <select @change="changeQuantity(cartProduct.id)" v-model="newQuantity" id="quandtity">
                                        <option value="null" disabled>Choisissez</option>
                                        <option v-for="i in 10" :value="i" :key="i">{{i}}</option>
                                    </select>
                                </div>
                                <button @click="deleteProduct(cartProduct.id)">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
            <div v-else class="alert alert-info mb-0 mt-5">
                Aucun produit n'est présent dans votre panier
            </div>
            <div class="totalShipping">
                <h3><b>Récapitulatif</b></h3>
                <div class="recap">
                    <div>
                        <p>Livraison</p>
                        <p>0,00 €</p>
                    </div>
                    <div>
                        <p><b>Total</b></p>
                        <p>{{getterTotalPrice}} €</p>
                    </div>
                    <button v-if="this.getterCart.length !== 0">Passer la commande</button>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import publicNav from "../components/publicNav"
    import {mapActions, mapGetters} from "vuex"
    export default {
        name:"ShoppingCart",
        components:{
            publicNav
        },
        data(){
            return{
                newQuantity:null
            }
        },
        computed:{
            ...mapGetters({
                getterCart:'cart/getterCart',
                getterTotalPrice:'cart/getterTotalPrice'
            })
        },
        methods:{
            ...mapActions({
                getCart:'cart/getCart',
                modifyQuantity:'cart/modifyQuantity'
            }),
            deleteProduct(id){
                this.getterCart.basket.forEach(book => {
                    if (book.id === id) {
                        this.getterCart.basket.splice(this.getterCart.basket.indexOf(book), 1)
                        localStorage.setItem('basketful',JSON.stringify(this.getterCart))
                        this.getCart()
                    }
                    if (this.getterCart.basket.length === 0){
                        localStorage.removeItem('basketful')
                        setTimeout(() =>{
                            this.getCart()
                        },600)

                    }
                })
            },
            changeQuantity(id) {
                let obj = {
                    id: id,
                    newQuantity: this.newQuantity
                }
                this.modifyQuantity(obj)
                this.getCart()
                this.newQuantity = null
            }
        },
        beforeMount(){
            this.getCart()
        }
    }
</script>
<style scoped lang="scss">
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    h4{
        width:90%;
        margin: 20px auto 0;
        padding-bottom:5px;
        border-bottom:1px solid black;
    }
    .shoppingCart {
        max-width: 1200px;
        width:95%;
        margin: 5px auto 20px;
        display: flex;
        justify-content: space-evenly;
        align-items: flex-start;
        .cart {
            width: 60%;
            .product {
                background-color: #eaeeef;
                padding: 10px;
                display: flex;
                justify-content: flex-start;
                border-radius: 3px;
                margin-top: 10px;
                align-items: center;
                .picture {
                    max-width:350px;
                    img {
                        object-fit: cover;
                        max-width: 100%;
                        height: auto;
                    }
                }
                .infoProduct {
                    margin-left:8px;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-start;
                    align-items: flex-start;
                    width:100%;
                    .firstName{
                        width: 100%;
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: space-between;
                        p:nth-child(1){
                            margin-bottom: 10px;
                        }
                    }
                    p {
                        margin-bottom: 0;
                    }
                    .secondName{
                        label{
                            margin:5px 0;
                        }
                        select{
                            padding:5px ;
                            border:1px solid #e8e8e8 !important;
                            border-radius:3px;
                            background-color: white;
                            outline: none;
                            margin-right: 5px;
                        }
                        button{
                            margin-top:10px;
                            border-radius: 3px;
                            background-color: white;
                            color: #b90000;
                            padding:5px;
                            outline: none;
                            border: 1px solid #b90000;
                            &:hover{
                                background-color: #b90000;
                                color: white;
                            }
                        }
                    }
                }
            }
        }
        .totalShipping{
            background-color: #f3f3f3;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #e2e2e2;
            margin-top: 10px;
            width: 25%;
            h3{
                text-align: center;
            }
            .recap {
                div {
                    display: flex;
                    justify-content: space-between;
                    align-items: baseline;
                    &:nth-child(3){
                        margin-bottom: 10px;
                        border-bottom: 0.5px solid black;
                        p{
                            margin: 0;
                        }
                    }
                }
                button {
                    border-radius: 5px;
                    background-color: #f3c962;
                    padding: 7px;
                    width:100%;
                    outline:none;
                    border: 1px solid #9a8757;
                    color: #382806;
                }
            }
        }
    }
    @media all and (max-width: 769px) {
        h4{
            width: 95%;
        }
        .shoppingCart{
            flex-direction: column-reverse;
            .cart{
                width: 100%;
                .product{
                    .infoProduct{
                        div:nth-child(1){
                            p:nth-child(1){
                                margin-right: 5px;
                            }
                        }
                    }
                }
            }
            .totalShipping{
                width: 100%;
                .recap{
                    button{
                        width: unset;
                    }
                }
            }
        }
    }
    @media all and (max-width: 376px) {
        .shoppingCart {
            .cart {
                .product {
                    flex-direction: column;
                    .infoProduct{
                        margin-left:0;
                        margin-top:10px;
                        .secondName{
                            button{
                                padding: 4px;
                            }
                        }
                    }
                }
            }
        }
    }
</style>