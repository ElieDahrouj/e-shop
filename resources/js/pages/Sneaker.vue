<template>
    <div>
        <publicNav></publicNav>
        <section class="product">
            <div class="manyPicture">
                <div v-for="manyPicture in pictureDataProduct" :key="manyPicture.id">
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
                    <select id="size">
                        <option disabled value="">Choisissez</option>
                        <option>EU 38</option>
                        <option>EU 40</option>
                        <option>EU 44</option>
                    </select>

                    <label for="quandtity">Quantité</label>
                    <select id="quandtity">
                        <option disabled value="">Choisissez</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <ul>
                    <li>Couleur : {{oneDataProduct.color}}</li>
                    <li>Date de sortie : {{dateOneProduct}}</li>
                </ul>
                <button>Ajouter au panier </button>
            </div>

        </section>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    import {mapActions, mapGetters} from 'vuex'
    export default {
        components:{
            publicNav
        },
        computed:{
            ...mapGetters(['oneDataProduct','pictureDataProduct','dateOneProduct'])
        },
        methods:{
            ...mapActions(['sneaker'])
        },
        beforeMount(){
            this.sneaker(this.$route.params.id)
        }
    }
</script>
<style scoped lang="scss">
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