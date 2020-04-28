<template>
    <div>
        <publicNav></publicNav>
        <header class="preview">
            <div>
                <img src="../assets/sport.jpg" alt="">
                <img src="https://getdolphins.com/wp-content/uploads/2019/02/891b4aa7-1b27-4979-8c21-b991ec2af153.png" alt="">
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
            <div>
                <h3>Titre de l'actu</h3>
                <span>publie le<b>22/01/2020</b></span>
                <p>resume de lactu </p>
            </div>
            <div>
                <h3>Titre de l'actu</h3>
                <span>publie le <b>22/01/2020</b></span>
                <p>resume de lactu </p>
            </div>
            <div>
                <h3>Titre de l'actu</h3>
                <span>publie le <b>22/01/2020</b></span>
                <p>resume de lactu </p>
            </div>
            <div>
                <h3>Titre de l'actu</h3>
                <span>publie le <b>22/01/2020</b></span>
                <p>resume de lactu </p>
            </div>
            <div>
                <h3>Titre de l'actu</h3>
                <span>publie le <b>22/01/2020</b></span>
                <p>resume de lactu </p>
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
        div{
            padding: 10px;
            margin: 0 15px 20px;
            border-radius: 3px;
            border: 1px solid black;
            min-width: 300px;
            p{
                margin:0;
            }
        }
    }
    @media all and (max-width: 769px) {
        .news{
            div{
                width: 100%;
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
</style>