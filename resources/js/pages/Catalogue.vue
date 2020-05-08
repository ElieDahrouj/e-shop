<template>
    <div>
        <publicNav></publicNav>
        <h1>
            <b>Toutes les marques</b>
        </h1>
        <section class="allMarque">
            <div v-for="brand in getterBrands" :key="brand.id" class="trend">
                <router-link :to="{ name: 'brand', params: { id: brand.id }}">
                    <div class="picture">
                        <img :src="brand.image" alt="">
                    </div>
                    <div class="infos">
                        <h2>{{brand.name}}</h2>
                        <p>Nombre de produit actifs: {{brand.products.length}}</p>
                    </div>
                </router-link>
            </div>
        </section>
        <div class="newSection">
            <h2>Tous les sneakers</h2>
        </div>
        <productsComponent :allSneakers="dataProducts" />
    </div>
</template>
<script>
    import publicNav from  '../components/publicNav'
    import productsComponent from '../components/products'
    import {mapActions,mapGetters} from 'vuex'
    export default {
        name:'catalogue',
        components:{
            publicNav,
            productsComponent
        },
        computed:{
            ...mapGetters(['dataProducts','getterBrands'])
        },
        methods:{
            ...mapActions(['allProducts'])
        },
        beforeMount(){
            this.allProducts()
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
        padding:8px;
        transition: transform .2s;
        border-radius:6px;
        &:hover{
            transform: scale(1.09);
            box-shadow: 0 5px 16px 0 RGBA(0,0,0,0.10);
        }
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
            grid-template-columns: repeat(auto-fit, 90%);
        }
    }
</style>