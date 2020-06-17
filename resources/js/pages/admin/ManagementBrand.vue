<template>
    <div>
        <navigation></navigation>
        <div class="container custom mb-4 mt-4">
            <div v-for="brand in adminBrand " :key="brand.id" class="card">
                <img :src="brand.banner" class="card-img-top" alt="...">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h3>{{brand.name}}</h3>
                    <p class="card-text">{{brand.description !== 'null'&& brand.description ? brand.description :'Aucune description'}}</p>
                    <div class="d-flex justify-content-between">
                        <p class="card-text m-0">
                            <button class="btn btn-danger" @click="deleteBrand(brand.id)"><font-awesome-icon class="search" :icon="['fas', 'trash']" /></button>
                        </p>
                        <p class="card-text m-0">
                            <button class="btn btn-light" @click="$bvModal.show('bv-modal-brand-edition'); edition(brand.id)"><font-awesome-icon class="search" :icon="['fas', 'pen']" /></button>
                        </p>
                    </div>
                </div>
                <div v-if="getterDeleteLoaderBrand && getterIdBrandLoader === brand.id" class="DeleteCart d-flex justify-content-center align-items-center w-100 h-100 position-absolute">
                    <div class="loaderDelete"></div>
                </div>
            </div>
        </div>
        <editionModalBrand></editionModalBrand>
    </div>
</template>
<script>
    import navigation from '../../components/Navigation'
    import {mapActions, mapGetters} from 'vuex'
    import editionModalBrand from '../../components/editionModalBrand'
    export default {
        name:'managementBrand',
        components:{
            navigation,
            editionModalBrand
        },
        computed:{
            ...mapGetters({
                adminBrand : 'admin/getterArrayBrands',
                getterDeleteLoaderBrand:'admin/getterDeleteLoaderBrand',
                getterIdBrandLoader:'admin/getterIdBrandLoader'
            })
        },
        methods:{
            ...mapActions({
                displayBrand : 'admin/adminBrand',
                deleteBrand: 'admin/deleteBrand',
                getOneBrand : 'admin/getOneBrand',
            }),
            brands(){
                this.displayBrand()
            },
            edition(id){
                this.getOneBrand(id)
            }
        },
        mounted(){
            if (!localStorage.getItem('token')){
                this.$router.replace({name:'admin.home'})
            }
            else{
                this.brands()
            }
        }
    }
</script>
<style scoped lang="scss">
    .custom{
        display: grid;
        justify-content: center;
        grid-gap: 50px;
        grid-template-columns: repeat(auto-fit, 275px);
    }
    .card{
        position: relative;
        top:0;
        transition: top 0.2s ease-in;
        &:hover{
            box-shadow: 0 5px 16px 0 RGBA(0, 0, 0, 0.12);
            top: -5px;
        }
    }
</style>