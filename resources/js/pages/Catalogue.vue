<template>
    <div>
        <publicNav></publicNav>
        <h1>
            <b>Toutes les marques</b>
        </h1>
        <section class="allMarque">
            <div class="trend">
                <a>
                    <div class="picture">
                        <img src="https://fr.trace.tv/wp-content/uploads/sites/2/2015/10/Nike-Logo-Brands-Sport.jpg" alt="">
                    </div>
                    <div class="infos">
                        <h2>Nike</h2>
                        <p>Nombre de produit actifs</p>
                    </div>
                </a>
            </div>
            <div class="trend">
                <a>
                    <div class="picture">
                        <img src="https://fr.trace.tv/wp-content/uploads/sites/2/2015/10/Nike-Logo-Brands-Sport.jpg" alt="">
                    </div>
                    <div class="infos">
                        <h2>Adidas</h2>
                        <p>Nombre de produit actifs</p>
                    </div>
                </a>
            </div>
            <div class="trend">
                <a>
                    <div class="picture">
                        <img src="https://fr.trace.tv/wp-content/uploads/sites/2/2015/10/Nike-Logo-Brands-Sport.jpg" alt="">
                    </div>
                    <div class="infos">
                        <h2>Reebok</h2>
                        <p>Nombre de produit actifs</p>
                    </div>
                </a>
            </div>
            <div class="trend">
                <a>
                    <div class="picture">
                        <img src="https://fr.trace.tv/wp-content/uploads/sites/2/2015/10/Nike-Logo-Brands-Sport.jpg" alt="">
                    </div>
                    <div class="infos">
                        <h2>Calvin Klein</h2>
                        <p>Nombre de produit actifs</p>
                    </div>
                </a>
            </div>
        </section>
    </div>
</template>
<script>
    import publicNav from  '../components/publicNav'
    export default {
        name:'catalogue',
        components:{
            publicNav
        }
    }
</script>
<style scoped lang="scss">
    h1{
        text-align: center;
        margin: 10px;
    }
    .allMarque{
        margin: 20px 0;
        display: grid;
        justify-content: center;
        grid-gap: 50px;
        grid-template-columns: repeat(auto-fit, 250px);
    }
    .trend{
        margin:8px;
        a {
            text-decoration: none;
            color: #660000;
            .picture {
                img {
                    max-width: 100%;
                }
            }
            .infos {
                h2{
                    font-size: 28px;
                }
                h2, p {
                    text-align: center;
                }
                p {
                    margin: 0;
                }
            }
        }
    }
    @media all and (max-width: 769px) {
        .allMarque{
            grid-template-columns: repeat(auto-fit, 150px);
        }
    }
    @media all and (max-width: 426px) {
        .allMarque{
            grid-template-columns: repeat(auto-fit, 95%);
        }
    }
</style>