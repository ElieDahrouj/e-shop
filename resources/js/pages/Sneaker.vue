<template>
    <div>
        <publicNav></publicNav>
        <section v-if="Object.keys(oneDataProduct).length !== 0" class="product">
            <div class="manyPicture">
                <div v-for="manyPicture in oneDataProduct.images" :key="manyPicture.id">
                    <img :src="manyPicture.image" alt="">
                </div>
            </div>
            <div class="infoAboutSneaker">
                <h2>{{oneDataProduct.name}}</h2>
                <span><b>Marque :</b> {{oneDataProduct.brand}}</span><br>
                <span><b>Prix :</b> {{oneDataProduct.price}} €</span>
                <p>
                    {{oneDataProduct.description}}
                </p>
                <div class="fieldToFull">
                    <label for="size">Sélectionner la taille</label>
                    <select v-model.trim="$v.size.$model" id="size">
                        <option disabled value="null">Choisissez</option>
                        <option v-for="i in 45"  v-if="i >= 38" :value="i" :key="i">{{i}}</option>
                    </select>

                    <label for="quantity">Quantité</label>
                    <select v-model.trim="$v.quantity.$model" id="quantity">
                        <option disabled value="null">Choisissez</option>
                        <option v-for="i in 10" :value="i" :key="i">{{i}}</option>
                    </select>
                </div>
                <ul>
                    <li>Couleur : {{oneDataProduct.color}}</li>
                    <li>Date de sortie : {{dateOneProduct}}</li>
                </ul>

                <transition name="fade">
                    <div v-if="result.status === 0" class="alert alert-danger">
                        {{result.msg}}
                    </div>
                </transition>

                <transition name="fade">
                    <div v-if="result.status === 1" class="alert alert-success">
                        <font-awesome-icon class="search" :icon="['fas', 'check-circle']" /> {{result.msg}}
                    </div>
                </transition>

                <button @click="addToCart">Ajouter au panier </button>
            </div>
        </section>
        <div v-else class="alert alert-danger mt-5 container"  role="alert">
            Cette paire n'existe pas, nous sommes désolé !
        </div>
    </div>
</template>
<script>
    import { required } from 'vuelidate/lib/validators'
    import publicNav from '../components/publicNav'
    import {mapActions, mapGetters} from 'vuex'
    export default {
        components:{
            publicNav
        },
        data(){
            return{
                size:null,
                quantity:null,
                check:false,
                result:{
                    status:null,
                    msg:null
                },
            }
        },
        validations: {
            size: {
                required,
            },
            quantity: {
                required,
            }
        },
        computed:{
            ...mapGetters(['oneDataProduct','dateOneProduct']),
        },
        methods:{
            ...mapActions(['sneaker']),
            ...mapActions({
                getCart:'cart/getCart'
            }),
            addToCart(){
                if (this.$v.quantity.required && this.$v.size.required) {
                    if (!localStorage.getItem('basketful')) {
                        let tab = []
                        let cart = {
                            "token": Math.random().toString(36).substr(2, 9),
                            "basket": tab
                        }

                        let infoCart = {
                            id:Date.now(),
                            size: this.size,
                            quantity: this.quantity,
                            product: this.oneDataProduct
                        };
                        tab.push(infoCart);

                        this.result.status = 1
                        this.result.msg = "Produit ajouté au panier"
                        setTimeout(() => {
                            this.result.status = null
                            this.result.msg = null
                            this.getCart()
                        },1500)

                        return localStorage.setItem('basketful', JSON.stringify(cart))
                    }
                    let basketful = JSON.parse(localStorage.getItem("basketful"));
                    if (JSON.parse(localStorage.getItem('basketful'))) {
                        basketful.basket.forEach(element => {
                            if (element.size === this.size && this.oneDataProduct.id === element.product.id) {
                                element.quantity += this.quantity
                                this.check = true
                            }
                            else {
                                this.check = false
                            }
                        })
                        localStorage.setItem('basketful', JSON.stringify(basketful))

                        if (!this.check) {
                            let infoCart = {
                                id:Date.now(),
                                size: this.size,
                                quantity: this.quantity,
                                product: this.oneDataProduct
                            };
                            basketful.basket.push(infoCart)

                            this.result.status = 1
                            this.result.msg = "Produit ajouté au panier"
                            setTimeout(() => {
                                this.result.status = null
                                this.result.msg = null
                                this.getCart()
                            },1500)

                            return localStorage.setItem('basketful', JSON.stringify(basketful))
                        }
                        this.result.status = 1
                        this.result.msg = "Produit ajouté au panier"
                        setTimeout(() => {
                            this.result.status = null
                            this.result.msg = null
                            this.getCart()
                        },1500)
                    }
                }
                else{
                    this.result.status = 0
                    this.result.msg = "Tous les champs sont obligatoire"
                    setTimeout(() => {
                        this.result.status = null
                        this.result.msg = null
                    },1500)
                }
            }
        },
        beforeMount(){
            this.sneaker(this.$route.params.id)
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
    .product{
        margin: 20px 0;
        display: flex;
        align-items: flex-start;
        .manyPicture{
            width: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 436px;
            overflow-y: scroll;
            margin-right: 15px;

            div{
                width: 375px;
                margin: 10px;
                img{
                    max-width: 100%;
                }
            }
        }
        .infoAboutSneaker{
            width: 50%;
            padding-right: 8px;
            .fieldToFull{
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                label{
                    margin:5px 0;
                }
                select{
                    padding:5px;
                    border:1px solid #e8e8e8;
                    border-radius:3px;
                }
            }
            button{
                background-color: #111111;
                border: 0.5px solid #111111;
                padding:10px;
                border-radius:3px;
                color:whitesmoke;
                outline: none;
            }
            ul{
                margin-top:5px;
            }
        }
    }
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: none;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 6px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
    }
    @media all and (max-width: 769px) {
        .product{
            flex-direction: column-reverse;
            .infoAboutSneaker{
                width: 95%;
                margin: auto;
            }
            .manyPicture{
                width:95%;
                margin: 15px auto;
                height:45vh;
            }
        }
    }
    @media all and (max-width: 426px) {
        .product {
            .manyPicture {
                height: auto;
                width: 95vw;
                flex-direction:row;
                overflow-x:scroll;
                overflow-y:unset;
                margin: 5px;
                div {
                    img{
                        max-width: 80vw;
                    }
                }
            }
        }
    }
</style>