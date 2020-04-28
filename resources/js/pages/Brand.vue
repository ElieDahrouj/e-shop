<template>
    <div>
        <publicNav></publicNav>
        <header class="brand">
            <div>
                <img src="https://www.dragonbleu.fr/media/catalog/category/DB_FR_BANNIERE_CATEG_2048x383y_150ko-max_Nike.jpg" alt="">
            </div>
            <div>
               <h1>Nike</h1>
                <p>comme la déesse de la victoire
                    est une société américaine créée en 1971 par Philip Knight et Bill Bowerman.
                    Basée à Beaverton dans l'Oregon, elle est spécialisée dans la fabrication d'articles de
                    sport (chaussures, vêtements et matériel de sport).
                </p>
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
    </div>
</template>
<script>
    import publicNav from  '../components/publicNav'
    export default {
        name:'brand',
        components:{
            publicNav
        }
    }
</script>
<style scoped lang="scss">
    .brand{
        div:nth-child(1){
            img{
                width: 100%;
            }
        }
        div:nth-child(2){
            h1{
                text-align: center;
                font-weight: bold;
            }
            p{
                width: 95%;
                margin: auto;
            }
        }
    }

    @media all and (max-width: 426px) {
        .brand{
            div:nth-child(2){
                p{
                    text-align: center;
                }
            }
        }
    }
</style>