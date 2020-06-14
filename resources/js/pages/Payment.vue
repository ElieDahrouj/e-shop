<template>
    <div>
        <publicNav></publicNav>
        <section v-if="this.getterCart.length !== 0" class="payement">
            <div class="fullField">
                <div class="shipping">
                    <h3>1. Shipping</h3>
                    <button @click="displayInfoCustomer" v-if="statusInfoCustomer">Edit</button>
                </div>
                <transition name="fadeHeight">
                    <form v-if="!statusInfoCustomer" class="firstInformations">
                        <div class="firstField">
                            <input v-model.trim="$v.infoCustomer.firstname.$model" class="field" type="text" placeholder="Nom">
                            <input v-model.trim="$v.infoCustomer.lastName.$model" class="field" type="text" placeholder="Prénom">
                        </div>
                        <input v-model.trim="$v.infoCustomer.address.$model" class="address" type="text" placeholder="Adresse">
                        <div class="secondField">
                            <input v-model.trim="$v.infoCustomer.postcode.$model" class="field" type="tel" maxlength="5" placeholder="Code Postal">
                            <input v-model.trim="$v.infoCustomer.city.$model" class="field" type="text" placeholder="Ville">
                        </div>
                        <div class="thirdField">
                            <input v-model.trim="$v.infoCustomer.mail.$model" class="field" type="email" placeholder="E-mail">
                            <input v-model.trim="$v.infoCustomer.phoneNumber.$model" class="field" type="tel" maxlength="10"  placeholder="Numéro de téléphone">
                        </div>

                        <p class="text-danger mb-3" v-if="this.msg"><b>{{msg}}</b></p>

                        <div class="validInformations">
                            <button @click.prevent="confirmInfoCustomer">Continuer</button>
                        </div>
                    </form>
                </transition>
            </div>
            <div class="fullField">
                <div class="shipping">
                    <h3>2. Paiement</h3>
                </div>
                <transition name="fadeHeight">
                    <form v-if="statusInfoCbCart" class="informationAboutPayement">
                        <div class="informationsCB">
                            <div class="numberCart">
                                <label for="cart">Numéro de carte</label>
                                <input v-model.trim="$v.infoCBcart.cartNumber.$model" id="cart" type="tel" maxlength="11" placeholder="Numéro de la carte">
                            </div>
                            <div class="expireDate">
                                <label for="month">Mois</label>
                                <select v-model.trim="$v.infoCBcart.month.$model" id="month">
                                    <option value="null" disabled>Mois</option>
                                    <option v-for="i in 12" :value="i" :key="i">{{i}}</option>
                                </select>
                            </div>
                            <div class="expireDate">
                                <label for="year">Année</label>
                                <select v-model.trim="$v.infoCBcart.year.$model" id="year">
                                    <option value="null" disabled>Année</option>
                                    <option v-for="i in 2040" v-if="i >= 2020" :value="i" :key="i">{{i}}</option>
                                </select>
                            </div>
                            <div class="secureCode">
                                <label for="secureCode">Code de sécurité</label>
                                <input v-model.trim="$v.infoCBcart.cartCVC.$model" type="tel" id="secureCode" maxlength="3" placeholder="XXX">
                            </div>
                        </div>
                        <div class="validCommand">
                            <button>Valider la commande</button>
                        </div>
                    </form>
                </transition>
            </div>
        </section>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    import {mapActions, mapGetters} from "vuex"
    import { required, email, minLength  } from 'vuelidate/lib/validators'
    export default {
        name:'payment',
        components:{
            publicNav
        },
        data(){
          return{
              infoCustomer:{
                  firstname:null,
                  lastName:null,
                  address:null,
                  postcode:null,
                  city:null,
                  mail:null,
                  phoneNumber:null
              },
              infoCBcart:{
                  cartNumber:null,
                  month:null,
                  year:null,
                  cartCVC:null
              },
              msg:null,
              statusInfoCustomer:false,
              statusInfoCbCart:false
          }
        },
        validations: {
            infoCustomer:{
                firstname:{
                    required
                },
                lastName:{
                    required
                },
                address:{
                    required
                },
                postcode:{
                    required,
                    minLength:minLength(5)
                },
                city:{
                    required
                },
                mail:{
                    required,
                    email
                },
                phoneNumber:{
                    required,
                    minLength:minLength(10)
                }
            },
            infoCBcart:{
                cartNumber:{
                    required,
                    minLength:minLength(16)
                },
                month:{
                    required,
                },
                year:{
                    required,
                },
                cartCVC:{
                    required,
                    minLength:minLength(3)
                }
            }
        },
        computed:{
            ...mapGetters({
                getterCart:'cart/getterCart',
            })
        },
        methods:{
            confirmInfoCustomer(){
                this.$v.infoCustomer.$touch()
                if (this.$v.infoCustomer.$invalid) {
                    this.msg = "Erreur les informations sont mal renseignés"
                }
                else{
                    this.msg = null
                    this.statusInfoCustomer = true
                    this.statusInfoCbCart = true
                }
            },
            displayInfoCustomer(){
                this.statusInfoCustomer = false
                this.statusInfoCbCart = false
            }
        }
    }
</script>
<style scoped lang="scss">
    @mixin colorInput(){
        padding: 10px;
        border: 1px solid #dedfe4;
        margin-bottom: 15px;
        outline:none;
        border-radius:3px;
        &:focus{
            border: 1px solid #222222;
        }
    }
    @mixin finalBtn(){
        padding: 8px 20px;
        color:#376242;
        background-color: #d4edda;
        border:1px solid #cae6d0;
        outline:none;
        &:hover{
            color: #fff;
            background-color: #218838;
        }
    }
    .payement{
        width: 95%;
        margin: 20px auto;
        .fullField {
            width: 70%;
            margin: auto;
            .shipping {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: #222222;
                padding: 5px;
                margin-bottom: 10px;
                h3 {
                    margin: 0;
                    color: whitesmoke;
                    font-size: 20px;
                }
                button {
                    border: none;
                    color: whitesmoke;
                    background-color: transparent;
                    outline: none;
                    text-decoration: underline;
                }
            }
            .firstInformations {
                .firstField, .secondField, .thirdField {
                    display: flex;
                    justify-content: space-between;
                }
                input{
                    @include colorInput;
                    &.field {
                        width: 48%;
                    }
                    &.address {
                        width: 100%;
                    }
                }
                .validInformations {
                    text-align: right;
                    button {
                        padding: 8px 20px;
                        color: #fff5e9;
                        background-color: #fa5400;
                        border: 1px solid #e3834f;
                        outline: none;
                        margin-bottom: 15px;
                        border-radius: 3px;
                        transition: 0.4s;
                        &:hover {
                            background: rgba(250, 84, 0, .75);
                        }
                    }
                }
            }
            .informationAboutPayement {
                .informationsCB {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    .numberCart, .expireDate, .secureCode {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        label {
                            width: 90%;
                        }
                        input,select {
                            @include colorInput;
                            width: 100%;
                        }
                    }
                }
                .validCommand{
                    text-align:right;
                    padding:10px;
                    button{
                        position: relative;
                        padding: 8px 20px;
                        font-size: 16px;
                        border-radius: 6px;
                        color: currentColor;
                        background: transparent;
                        border: 2px solid #218838;
                        outline: none;
                        cursor: pointer;
                        overflow: hidden;
                        transition: 0.6s;

                        &::before {
                            position: absolute;
                            content: "";
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background: linear-gradient(
                                            120deg,
                                            transparent,
                                            #218838,
                                            transparent
                            );
                            transform: translateX(-100%);
                            transition: 0.6s;
                        }

                        &:hover {
                            box-shadow: 0 0 4px 0 #218838;
                        }

                        &:hover::before {
                            transform: translateX(100%);
                        }
                    }
                }
            }
        }
    }
    @media all and (max-width: 816px){
        .payement{
            .fullField{
                .informationAboutPayement {
                    .informationsCB {
                        align-items: flex-start;
                        flex-direction: column;
                        .numberCart, .expireDate, .secureCode {
                            align-items: flex-start;
                            width: 100%;
                            input, select {
                                width: 100%;
                            }
                            label {
                                width: 100%;
                            }
                        }
                    }
                }
            }
        }
    }
    @media all and (max-width: 426px) {
        .payement {
            .fullField {
                .shipping {
                    h3{
                        font-size: 15px;
                    }
                }
                .firstInformations {
                    .firstField, .secondField, .thirdField {
                        flex-direction: column;
                        input{
                            width: 100%;
                        }
                    }
                }
                .informationAboutPayement {
                    .validCommand{
                        padding: 0;
                        button{
                            width:100%;
                        }
                    }
                }
            }
        }
    }
</style>