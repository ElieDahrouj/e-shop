<template>
    <div>
        <header id="header" class="container">
            <navigation></navigation>
        </header>
        <div class="container">
            <div class="card card-default pb-3">
                <div class="card-header"><em>Admin Dashboard</em></div>

                <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                    <span class="mr-1">Bienvenue sur votre dashboard administrateur</span>
                    <div>
                        <router-link :to="{name:'home'}"><button class="btn btn-light">Retour au site</button></router-link>
                    </div>
                </div>
                <div class="container custom">
                    <btnAdmin :className="brand" name="Marques" :url="brandUrl"></btnAdmin>
                    <!-- <btnAdmin :className="sneakers" name="Sneakers"></btnAdmin>
                    <btnAdmin :className="news" name="News"></btnAdmin> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import navigation from '../../components/Navigation'
    import btnAdmin from '../../components/btnAdmin'
    export default {
        name:'dashboard',
        data(){
          return{
              brand:"brand",
              sneakers:"sneakers",
              news:"btnNews",
              brandUrl:"/managementBrand"
          }
        },
        components:{
            navigation,
            btnAdmin
        }
    }
</script>
<style scoped lang="scss">
    .custom{
        display: grid;
        justify-content: center;
        grid-gap: 50px;
        grid-template-columns: repeat(auto-fit, 200px);
    }
    @media all and (max-width: 426px) {
        .card-body{
            justify-content: center!important;
            div{
                margin-top:5px;
            }
        }
    }
</style>