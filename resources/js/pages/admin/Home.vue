<template>
    <div>
        <header id="header" class="container">
            <navigation></navigation>
        </header>
        <div class="container mt-4 mb-2">
            <div class="card card-default">
                <div class="card-header"><b>Bienvenue</b></div>
                <div class="picture"><img src="../../assets/test.png" class="card-img-top" alt="..."></div>
                <div class="card-body text-center">
                    <p>Bienvenue sur la page d'administration du site THE HEAVENS</p>
                    <p>
                        Cette partie du site permet de gérer l'ensemble des chaussures, les marques présentes et les news.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import navigation from '../../components/Navigation'
    export default {
        name:'home',
        components:{
            navigation
        }
    }
</script>
<style scoped lang="scss">
    .picture{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        img{
            margin-top: 20px;
            width: 150px;
        }
    }
</style>