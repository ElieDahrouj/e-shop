<template>
    <b-modal id="bv-modal-brand" hide-footer>
        <template v-slot:modal-title>Ajouter une nouvelle marque</template>
        <form @submit="formSubmit" enctype="multipart/form-data">
            <b-form-group id="input-group-2" label-for="input-2">
                <div class="mt-2">Nom de la marque: <b class="text-danger">*</b></div>
                <b-form-input id="input-2" v-model="brandForm.brandName" required placeholder="Enter name"></b-form-input>
            </b-form-group>

            <div class="mt-2">Selectionner une bannière: <b class="text-danger">*</b> <span class="text-info" v-if="brandForm.banner">{{brandForm.banner.name}}</span></div>
            <b-form-file v-model="brandForm.banner" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>

            <div class="mt-2">Selectionner une icône: <b class="text-danger">*</b> <span class="text-info" v-if="brandForm.icone">{{ brandForm.icone.name }}</span></div>
            <b-form-file v-model="brandForm.icone" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>

            <b-form-textarea class="mt-3" id="textarea" v-model="brandForm.description" placeholder="Enter description..." rows="3" max-rows="6"></b-form-textarea>

            <transition name="fade">
                <p class="my-2" v-if="alertMsg">
                    <span class="text-danger" v-if="alertMsg.type === 0">{{alertMsg.msg}}</span>
                    <span class="text-success" v-if="alertMsg.type === 1">{{alertMsg.msg}}</span>
                </p>
            </transition>

            <div v-if="getterCreateLoaderBrand" class="d-flex justify-content-start align-items-center">
                <div class="loader"></div><p class="textCustom ml-2 m-0 my-2">En attente d'ajout</p>
            </div>

            <b-button class="mt-3" type="submit" variant="success">Ajouter</b-button>
        </form>
    </b-modal>
</template>
<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name:'modalBrandAdmin',
        data(){
            return{
                brandForm:{
                    banner:null,
                    brandName:null,
                    description :null,
                    icone:null
                }
            }
        },
        computed:{
            ...mapGetters({
                alertMsg: 'admin/getterMsg',
                getterCreateLoaderBrand:'admin/getterCreateLoaderBrand'
            })
        },
        methods:{
            ...mapActions({
                createBrand : 'admin/createBrand'
            }),
            formSubmit(e) {
                e.preventDefault();

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('image', this.brandForm.icone);
                formData.append('name', this.brandForm.brandName);
                formData.append('banner', this.brandForm.banner);

                if (this.brandForm.description != null){
                    formData.append('description', this.brandForm.description);
                }
                this.createBrand(formData,config)
                setTimeout(() =>{
                    if (this.alertMsg.type) {
                        if (this.alertMsg.type === 1) {
                            this.brandForm.brandName = null
                            this.brandForm.icone = null
                            this.brandForm.banner = null
                            if (this.brandForm.description) {
                                this.brandForm.description = null
                            }
                        }
                    }
                },3500)
            }
        }
    }
</script>
<style lang="scss" scoped>
    .error{
        color: red;
        margin-top: 5px;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>