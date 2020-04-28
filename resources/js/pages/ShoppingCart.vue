<template>
    <div>
        <publicNav></publicNav>
        <h4><b>Panier</b></h4>
        <section class="shoppingCart">
            <div class="cart">
                <div class="product">
                    <div class="picture">
                        <img src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/16775526-718f-41dd-9106-40b94898b722/chaussure-air-jordan-1-mid-D3DnDx.jpg" alt="">
                    </div>
                    <div class="infoProduct">
                        <div>
                            <p><router-link to="/">Nike Zoom 35p </router-link></p>
                            <p><b>Prix : </b>110€</p>
                        </div>
                        <p><b>Coloris : </b> BLeu</p>
                        <p><b>Taille : </b> 40</p>
                        <label for="quandtity">Quantité désirée</label>
                        <select id="quandtity">
                            <option disabled value="">Choisissez</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                        <button>
                            Supprimer
                        </button>
                    </div>
                </div>
                <div class="product">
                    <div class="picture">
                        <img src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/16775526-718f-41dd-9106-40b94898b722/chaussure-air-jordan-1-mid-D3DnDx.jpg" alt="">
                    </div>
                    <div class="infoProduct">
                        <div>
                            <p><router-link to="/">Nike Zoom 35p </router-link></p>
                            <p><b>Prix : </b>110€</p>
                        </div>
                        <p><b>Coloris : </b> BLeu</p>
                        <p><b>Taille : </b> 40</p>
                        <label for="quandtity">Quantité désirée</label>
                        <select id="quandtity">
                            <option disabled value="">Choisissez</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                        <button>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
            <div class="totalShipping">
                <h3><b>Récapitulatif</b></h3>
                <div class="recap">
                    <div>
                        <p>Souts-total</p>
                        <p>0 €</p>
                    </div>
                    <div>
                        <p>Livraison</p>
                        <p>0,00 €</p>
                    </div>
                    <div>
                        <p><b>Total</b></p>
                        <p>0 €</p>
                    </div>
                    <button>Passer la commande</button>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import publicNav from "../components/publicNav"
    export default {
        name:"ShoppingCart",
        components:{
            publicNav
        }
    }
</script>
<style scoped lang="scss">
    h4{
        width:90%;
        margin: 20px auto 0;
        padding-bottom:5px;
        border-bottom:1px solid black;
    }
    .shoppingCart {
        width:95%;
        margin: 5px auto 20px;
        display: flex;
        justify-content: space-evenly;
        align-items: flex-start;
        .cart {
            width: 75%;
            .product {
                background-color: #eaeeef;
                padding: 10px;
                display: flex;
                justify-content: flex-start;
                border-radius: 3px;
                margin-top: 10px;
                align-items: flex-start;
                .picture {
                    max-width:250px;
                    img {
                        object-fit: cover;
                        max-width: 100%;
                        height: auto;
                    }
                }
                .infoProduct {
                    margin-left:5px;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-start;
                    align-items: flex-start;
                    width:100%;
                    div:nth-child(1){
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
                    label{
                        margin:5px 0;
                    }
                    select{
                        padding:5px;
                        border:1px solid #e8e8e8;
                        border-radius:3px;
                        outline: none;
                    }
                    button{
                        margin-top:10px;
                        border-radius: 3px;
                        background-color: white;
                        color: #b90000;
                        padding:8px;
                        border: 1px solid #b90000;
                        &:hover{
                            background-color: #b90000;
                            color: white;
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
        .shoppingCart{
            flex-direction: column-reverse;
            .cart{
                width: 100%;
                .product{
                    .picture{
                        max-width: 600px;
                    }
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
                    }
                    .picture{
                        max-width: 100%;
                    }
                }
            }
        }
    }
</style>