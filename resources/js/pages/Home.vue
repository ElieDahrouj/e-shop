<template>
    <div>
        <publicNav></publicNav>
        <header class="preview">
            <div>
                <img src="../assets/sport.jpg" alt="">
                <img src="../assets/mobile.png" alt="">
            </div>
        </header>
        <section class="allProduct">
            <div class="product">
                <a href="">
                    <div>
                        <img src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/i1-e249e8d9-6502-4ad1-8d90-0782f1f23c5c/chaussure-air-max-2090-pour-Q4hHnH.jpg" alt="">
                    </div>
                    <div>
                        <p>Nike Zoom 35p </p>
                        <p>110$</p>
                    </div>
                </a>
            </div>
            <div class="product">
                <a href="#">
                    <div>
                        <img src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/16775526-718f-41dd-9106-40b94898b722/chaussure-air-jordan-1-mid-D3DnDx.jpg" alt="">
                    </div>
                    <div>
                        <p>Nike Zoom 35p </p>
                        <p>110$</p>
                    </div>
                </a>
            </div>
            <div class="product">
                <a href="">
                    <div>
                        <img src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/i1-cb9feeb4-43d3-4263-8fc5-230cbb5c36f0/chaussure-dentrainement-fractionne-haute-intensite-air-zoom-superrep-pour-gSWSxQ.jpg" alt="">
                    </div>
                    <div>
                        <p>Nike Zoom 35p </p>
                        <p>110$</p>
                    </div>
                </a>
            </div>
            <div class="product">
                <a href="">
                    <div>
                        <img src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/ae4c4897-9831-4af0-8d80-54bd27be013e/chaussure-air-jordan-1-low-se-pour-ZJmFq2.jpg" alt="">
                    </div>
                    <div>
                        <p>Nike Zoom 35p </p>
                        <p>110$</p>
                    </div>
                </a>
            </div>
        </section>
        <div class="newSection">
            <h2>Actualités</h2>
        </div>
        <section class="news">
            <article>
                <div>
                    <div>
                        <h3>Nike Court Vintage Premium</h3>
                        <span><em>Date de publication: 22/01/2020</em></span>
                    </div>

                    <p>
                        Décontractée et tendance, la Nike Court Vintage Premium incarne l'âge d'or du tennis des années 80. L'empeigne en cuir souple et le petit logo affichent un style décontracté, tandis
                        que l'amorti de la semelle de propreté offre un confort optimal à chaque pas...
                    </p>
                    <button>Lire l'article</button>
                </div>
                <div>
                    <img src="https://www.lesitedelasneaker.com/wp-content/images/2019/12/nike-colin-kaepernick-air-force-1-low-1100x733.jpg" alt="">
                </div>
            </article>
            <article>
                <div>
                    <div>
                        <h3>Nike Court Vintage Premium</h3>
                        <span><em>Date de publication: 22/01/2020</em></span>
                    </div>

                    <p>
                        Décontractée et tendance, la Nike Court Vintage Premium incarne l'âge d'or du tennis des années 80. L'empeigne en cuir souple et le petit logo affichent un style décontracté, tandis
                        que l'amorti de la semelle de propreté offre un confort optimal à chaque pas...
                    </p>
                    <button>Lire l'article</button>
                </div>
                <div>
                    <img src="https://cdn-media.rtl.fr/online/image/2019/0116/7796245819_la-nike-adapt-bb-utilise-un-petit-moteur-pour-ajuster-le-serrage-de-la-chaussure-en-fonction-de-la-forme-du-pied.jpg" alt="">
                </div>
            </article>
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
<style lang="scss">
    .allProduct{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 95%;
        margin: 20px auto;
        .product{
            background-color: #eaeeef;
            min-width: 100px;
            max-width: 250px;
            padding: 10px;
            border-radius: 3px;
            margin-right: 10px;
            margin-top: 10px;
            a {
                text-decoration: none;
                color: #041f54;
                div:nth-child(1) {
                    img {
                        width: 100%;
                        object-fit: cover;
                        max-width: 100%;
                        height: auto;
                    }
                }
                div:nth-child(2) {
                    display: flex;
                    justify-content: space-between;
                    p {
                        margin-top: 10px;
                        margin-bottom: 0;
                    }
                }
            }
        }
    }
    .preview{
        div{
            img:nth-child(1){
                width: 100%;
                display: block;
            }
            img:nth-child(2){
                display: none;
                width: 100%;
            }
        }
    }
    .newSection{
        text-align: center;
        font-weight: bold;
        text-decoration:underline;
    }
    .news{
        width: 95%;
        margin: 15px auto;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        flex-wrap: wrap;
        article{
            display: flex;
            width: 100%;
            max-width: 1200px;
            padding: 10px;
            border-radius:6px;
            background-color: #191919;
            justify-content: space-evenly;
            &:not(:last-child){
                margin-bottom: 35px;
            }
            div:nth-child(1){
                width: 400px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items:flex-start;
                div:nth-child(1){
                    h3{
                        color: #60837f;
                    }
                    span{
                        color: #60837f;
                    }
                }
                p{
                    color: #a4a6a5;
                    padding-right: 15px;
                }
                button{
                    border-radius: 3px;
                    padding: 10px;
                    border: 1px solid #ecedef;
                    background: transparent;
                    font-weight: bold;
                    color: #ecedef;
                    &:hover{
                        background-color: #ecedef;
                        color: #191919;
                    }
                }
            }
            div:nth-child(2){
                width: 600px;
                img{
                    max-width: 100%;
                    border-radius:6px
                }
            }
        }
    }
    @media all and (max-width: 769px) {
        .news{
            article{
                flex-direction: column-reverse;
                width: unset;
                div:nth-child(1) {
                    div:nth-child(1) {
                        margin-top: 5px;
                        h3 {
                            color: #60837f;
                            margin: 0;
                        }
                        span {
                            color: #60837f;
                            margin-bottom: 10px;
                        }
                    }
                }
                div:nth-child(2){
                    width:400px;
                }
            }
        }
    }
    @media all and (max-width: 545px) {
        .allProduct {
            .product {
                max-width: 320px;
                margin-right: 0;
            }
        }
        .preview{
            div{
                img:nth-child(1){
                    width: 100%;
                    display: none;
                }
                img:nth-child(2){
                    width: 100%;
                    display: block;
                }
            }
        }
    }
    @media all and (max-width: 426px) {
        .news{
            article{
                width: 100%;
                div:nth-child(1){
                    width: 100%;
                    p{
                        padding-right:0;
                    }
                }
                div:nth-child(2){
                    width:100%;
                }
            }
        }
    }
</style>