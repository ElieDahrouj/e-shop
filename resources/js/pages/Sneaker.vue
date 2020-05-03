<template>
    <div>
        <publicNav></publicNav>
        <section class="product">
            <div class="manyPicture">
                <div>
                    <img src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/b5caf032-fd90-4baa-bd11-75e2c97e39e2/chaussure-air-max-2090-pour-cLlWqx.jpg" alt="">
                </div>
                <div>
                    <img src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5,q_80/a3b3d811-483d-4ade-8a1a-101b75b127a3/chaussure-air-max-2090-pour-cLlWqx.jpg" alt="">
                </div>
                <div>
                    <img src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5,q_80/fce5eec6-22d6-4c28-b93f-41e532656cd9/chaussure-air-max-2090-pour-cLlWqx.jpg" alt="">
                </div>
            </div>
            <div class="infoAboutSneaker">
                <h2>Nike Air Max 2090</h2>
                <span><b>Prix :</b> 150 €</span>
                <p>
                    Faites le lien entre le passé et l'avenir avec la Nike Air Max 2090,
                    un modèle audacieux inspiré de l'ADN de l'emblématique Air Max 90.
                    Le tout nouvel amorti Nike Air sous le pied procure une sensation de confort inégalée,
                    tandis que le tissu transparent de l'empeigne est associé à des éléments intemporels de
                    l'OG pour un look stylé et moderne.
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
                    <li>Couleur disponible : Bleu glacé/Orange laser/Blanc/Noir</li>
                    <li>Date de sortie : 10/08/2019</li>
                </ul>
                <button>Ajouter au panier </button>
            </div>

        </section>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    export default {
        components:{
            publicNav
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