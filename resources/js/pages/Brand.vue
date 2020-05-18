<template>
    <div>
        <publicNav></publicNav>
        <header v-if="Object.keys(getterBrands).length !== 0" class="brand">
            <div>
                <img :src="getterBrands.banner" alt="">
            </div>
            <div>
               <h1 class="mt-1">{{getterBrands.name}}</h1>
                <p v-if="getterBrands.description">{{getterBrands.description}}</p>
            </div>
        </header>
        <productsComponent v-if="Object.keys(getterBrands).length !== 0" :allSneakers="getterBrands.products"/>
        <div v-else class="alert alert-danger mt-5 container"  role="alert">
            Cette marque n'existe pas, nous sommes désolé !
        </div>
    </div>
</template>
<script>
    import publicNav from  '../components/publicNav'
    import productsComponent from '../components/products'
    import {mapActions ,mapGetters} from 'vuex'
    export default {
        name:'brand',
        components:{
            publicNav,
            productsComponent
        },
        computed:{
            ...mapGetters(['getterBrands'])
        },
        methods:{
            ...mapActions(['allProductsByBrand'])
        },
        beforeMount(){
            this.allProductsByBrand(this.$route.params.id)
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