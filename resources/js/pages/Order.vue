<template>
    <div>
        <publicNav></publicNav>
        <header v-if="displayProduct !== null && displayInfoCustomer !== null " class="my-3">
            <div id="shipping" class="d-flex align-items-center flex-column">
                <font-awesome-icon class="sizeIcone" :icon="['fas', 'shipping-fast']" />
                <p class="mb-0 mt-2 font-weight-bold">Merci {{displayInfoCustomer.firstname}}</p>
                <p class="mt-0">À Bientot !</p>
            </div>

            <div id="numberOrder" class="d-flex align-items-center justify-content-center mt-3">
                <div class="mr-4">
                    <p class="mb-0 text-center "><font-awesome-icon :icon="['fas', 'store-alt']" /></p>
                    <p class="mb-0 text-center font-weight-bold">{{displayProduct.token}}</p>
                    <p class="text-center">Numéro de commande</p>
                    <p class="mb-0 text-center"><font-awesome-icon :icon="['fas', 'receipt']" /></p>
                    <p class="mb-0 text-center">Total <b>{{getterOrderPrice}}</b> €</p>
                </div>
                <div>
                    <h3 class="font-weight-bold">Adresse de facturation</h3>
                    <p class="mb-0">Nom: <b>{{displayInfoCustomer.lastName}}</b></p>
                    <p class="mb-0">Prénom: <b>{{displayInfoCustomer.firstname}}</b></p>
                    <p class="mb-0">Adresse <font-awesome-icon :icon="['fas', 'map-marker-alt']" /> : <b>{{displayInfoCustomer.address}} {{displayInfoCustomer.postcode}} {{displayInfoCustomer.city}}</b></p>
                    <p class="mb-0">E-mail: <b>{{displayInfoCustomer.mail}}</b></p>
                    <p class="mb-0">Numéro de téléphone <font-awesome-icon :icon="['fas', 'mobile-alt']" /> : <b>{{displayInfoCustomer.phoneNumber}}</b></p>
                </div>
            </div>

            <div class="mt-2 container" id="orderProducts">
                <div class="oneProduct" v-for="(productsBuying,index) in displayProduct.basket" :key="index">
                    <div>
                        <img :src="productsBuying.product.image" alt="">
                    </div>
                    <div>
                        <p class="mb-0">{{productsBuying.product.name}}</p>
                        <p class="mb-0"><b>Couleur:</b> {{productsBuying.product.color}} </p>
                        <p class="mb-0"><b>Prix:</b> {{productsBuying.product.price}} €</p>
                        <p class="mb-0"><b>quantité:</b> {{productsBuying.quantity}}</p>
                        <p><b>Taille:</b> {{productsBuying.size}} EU</p>
                    </div>
                </div>
            </div>
        </header>
        <div class="text-center mt-3" v-else>
            <router-link :to="{name:'home'}"><button class="btn btn-dark">Retour à l'accueil</button></router-link>
        </div>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    import {mapGetters} from 'vuex'
    export default {
        name:'Order',
        components:{
            publicNav
        },
        computed:{
            ...mapGetters({
                getterOrderPrice:'cart/getterOrderPrice'
            })
        },
        data(){
            return{
                displayInfoCustomer:{},
                displayProduct:{}
            }
        },
        mounted(){
            this.displayInfoCustomer = JSON.parse(localStorage.getItem('infoCustomer'))
            this.displayProduct = JSON.parse(localStorage.getItem('basketful'))
            localStorage.removeItem('infoCustomer')
            localStorage.removeItem('basketful')
        }
    }
</script>
<style scoped lang="scss">
    #shipping{
        .sizeIcone{
            font-size: 100px;
        }
        p:nth-child(2){
            font-size: 20px;
        }
        p:nth-child(3){
            color: #a5a5a5;
        }
    }
    #numberOrder{
        div{
            border: 1px solid #dadada;
            padding: 15px;
            border-radius: 6px;
        }
        div:nth-child(1){
            p:nth-child(1){
                font-size: 20px;
            }
            p:nth-child(4){
                font-size: 22px;
            }
        }
    }
    #orderProducts{
        display: grid;

        grid-row-gap: 20px;
        grid-template-columns: repeat(auto-fit, 230px);
        justify-content: center;
        .oneProduct{
            margin:8px;
            div:nth-child(1){
                img{
                    max-width: 100%;
                }
            }
        }
    }
    @media all and (max-width:524px){
        #numberOrder{
            flex-direction: column;
            div:nth-child(1){
                margin-right: 0 !important;
                margin-bottom: 15px;
            }
        }
    }
</style>