<template>
    <div>
        <navigation></navigation>
        <div class="container custom mb-4 mt-4">
            <div v-for="products in adminProducts " :key="products.id" class="card">
                <img :src="products.image" class="card-img-top" alt="...">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h3>{{products.name}}</h3>
                    <p class="card-text">{{products.price}} €</p>
                    <p class="card-text">{{products.brand}}</p>
                    <p class="card-text">{{products.color}}</p>
                    <p class="card-text"><b>Etat de publication: </b>{{products.actif===1 ? 'Oui':'Non'}}</p>
                    <p class="card-text"><b>Date de sortie:</b> {{products.release_date}}</p>
                    <p class="card-text">{{products.description}}</p>
                    <div class="d-flex justify-content-between mt-2">
                        <p class="card-text m-0">
                            <button class="btn btn-danger" @click="deleteSneaker(products.id)"><font-awesome-icon class="search" :icon="['fas', 'trash']" /></button>
                        </p>
                        <p class="card-text m-0">
                            <button class="btn btn-light" @click="$bvModal.show('bv-modal-sneakersEdition'); edition(products.id)"><font-awesome-icon class="search" :icon="['fas', 'pen']" /></button>
                        </p>
                    </div>
                </div>
                <div v-if="getterDeleteLoaderProduct && getterIdProductLoader === products.id" class="DeleteCart d-flex justify-content-center align-items-center w-100 h-100 position-absolute">
                    <div class="loaderDelete"></div>
                </div>
            </div>
        </div>
        <editionModalProduct></editionModalProduct>
    </div>
</template>
<script>
    import navigation from '../../components/Navigation'
    import editionModalProduct from '../../components/editionModalProduct'
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name:'managementBrand',
        components:{
            navigation,
            editionModalProduct
        },
        computed:{
            ...mapGetters({
                adminProducts : 'admin/getterArrayProducts',
                getterDeleteLoaderProduct:'admin/getterDeleteLoaderProduct',
                getterIdProductLoader:'admin/getterIdProductLoader'
            })
        },
        methods:{
            ...mapActions({
                displayProducts : 'admin/adminProducts',
                deleteSneaker :'admin/deleteSneaker',
                getOneProduct:'admin/getOneProduct'
            }),
            edition(id){
                this.getOneProduct(id)
            }
        },
        mounted(){
            if (!localStorage.getItem('token')){
                this.$router.replace({name:'admin.home'})
            }
            else{
                this.displayProducts()
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
    .card-text{
        white-space: nowrap;
        overflow: hidden;
        margin: 0;
        color: #161616;
        text-overflow: ellipsis;
    }
</style>