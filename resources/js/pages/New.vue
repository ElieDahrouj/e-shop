<template>
    <div>
        <publicNav></publicNav>
        <section class="new">
            <h1><b>Nike Court Vintage Premium</b></h1>
            <img src="https://cdn-media.rtl.fr/online/image/2019/0116/7796245819_la-nike-adapt-bb-utilise-un-petit-moteur-pour-ajuster-le-serrage-de-la-chaussure-en-fonction-de-la-forme-du-pied.jpg" alt="">
            <p><em>Résume de l'article</em></p>
            <p>
                Décontractée et tendance, la Nike Court Vintage Premium incarne
                l'âge d'or du tennis des années 80. L'empeigne en cuir souple et
                le petit logo affichent un style décontracté, tandis que l'amorti de
                la semelle de propreté offre un confort optimal à chaque pas.
            </p>
        </section>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    export default {
        name:'new',
        components:{
            publicNav
        }
    }
</script>
<style scoped lang="scss">
    .new{
        width: 85%;
        margin: 20px auto;
        h1{
            text-align:center;
        }
        img{
            margin-bottom: 5px;
            padding: 0 150px;
            width: 100%;
        }
        p{
            text-align: justify;
        }
    }
    @media all and (max-width: 769px) {
        .new{
            img{
                padding: 0;
            }
        }
    }
</style>