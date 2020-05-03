<template>
    <div>
        <publicNav></publicNav>
        <section class="payement">
            <div class="fullField">
                <div class="shipping">
                    <h3>1. Shipping</h3>
                    <button>Edit</button>
                </div>
                <form class="firstInformations">
                    <div class="firstField">
                        <input class="field" type="text" placeholder="Nom">
                        <input class="field" type="text" placeholder="Prénom">
                    </div>
                    <input class="address" type="text" placeholder="Adresse">
                    <div class="secondField">
                        <input class="field" type="text" placeholder="Code Postal">
                        <input class="field" type="text" placeholder="Ville">
                    </div>
                    <div class="thirdField">
                        <input class="field" type="email" placeholder="E-mail">
                        <input class="field" type="tel" placeholder="Numéro de téléphone">
                    </div>
                    <div class="validInformations">
                        <button >Continuer</button>
                    </div>
                </form>
            </div>
            <div class="fullField">
                <div class="shipping">
                    <h3>2. Paiement</h3>
                    <button>Edit</button>
                </div>
                <form class="informationAboutPayement">
                    <div class="informationsCB">
                        <div class="numberCart">
                            <label for="cart">Numéro de carte</label>
                            <input id="cart" type="tel" maxlength="11" placeholder="Numéro de la carte">
                        </div>
                        <div class="expireDate">
                            <label for="expireDate">Date d'expiration</label>
                            <input id="expireDate" type="tel" maxlength="4" placeholder="MM/YY">
                        </div>
                        <div class="secureCode">
                            <label for="secureCode">Code de sécurité</label>
                            <input type="tel" id="secureCode" maxlength="3" placeholder="XXX">
                        </div>
                    </div>
                    <div class="validCommand">
                        <button>Valider la commande</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    export default {
        name:'payment',
        components:{
            publicNav
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
                input {
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
                        input {
                            @include colorInput;
                            width: 90%;
                        }
                    }
                }
                .validCommand{
                    text-align:right;
                    padding:10px;
                    button{
                        @include finalBtn;
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
                    .informationsCB {
                        align-items: flex-start;
                        flex-direction: column;
                        .numberCart, .expireDate, .secureCode {
                            align-items: flex-start;
                            width: 100%;
                            input {
                                width: 100%;
                            }
                            label {
                                width: 100%;
                            }
                        }
                    }
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