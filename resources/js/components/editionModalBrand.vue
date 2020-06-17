<template>
        <b-modal id="bv-modal-brand-edition" hide-footer>
            <template v-slot:modal-title>Modification de la marque {{getterEditionBrand.name}}</template>
            <form @submit="formSubmit">
                <b-form-group id="input-group-2" label-for="input-2">
                    <div class="mt-2">Nom de la marque:</div>
                    <b-form-input id="input-2" v-model="getterEditionBrand.name" required placeholder="Enter new name"></b-form-input>
                </b-form-group>

                <div class="mt-2">Changer la bannière: <b class="text-danger">*</b> <span class="text-info" v-if="editForm.banner">{{editForm.banner.name}}</span></div>
                <b-form-file v-model="editForm.banner" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>

                <div class="mt-2 text-info font-weight-bold">Bannière actuelle:</div>
                <img class="w-100" :src="getterEditionBrand.banner" alt="">

                <div class="mt-2">Changer d'icône: <b class="text-danger">*</b> <span class="text-info" v-if="editForm.icone">{{editForm.icone.name }}</span></div>
                <b-form-file v-model="editForm.icone" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>

                <div class="mt-2 text-info font-weight-bold">Icône actuelle:</div>
                <img class="widthCustom" :src="getterEditionBrand.image" alt="">

                <div class="mt-3">Description: <b class="text-danger">*</b></div>
                <b-form-textarea id="textarea" v-model="getterEditionBrand.description" placeholder="Enter description..." rows="3" max-rows="6"></b-form-textarea>

                <transition name="fade">
                    <p class="my-2" v-if="alertMsg">
                        <span class="text-danger" v-if="alertMsg.type === 0">{{alertMsg.msg}}</span>
                        <span class="text-success" v-if="alertMsg.type === 1">{{alertMsg.msg}}</span>
                    </p>
                </transition>

                <div v-if="getterLoaderUpdateBrand" class="d-flex justify-content-start align-items-center">
                    <div class="loader"></div><p class="textCustom ml-2 m-0 my-2">Mise à jour en cours</p>
                </div>
                <b-button class="mt-3" type="submit" variant="success">Modifier</b-button>
            </form>
        </b-modal>
</template>
<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name:'editionModalBrand',
        data(){
            return{
                editForm:{
                    banner:null,
                    icone:null
                }
            }
        },
        computed:{
            ...mapGetters({
                alertMsg: 'admin/getterMsg',
                getterEditionBrand: 'admin/getterEditionBrand',
                getterLoaderUpdateBrand:'admin/getterLoaderUpdateBrand'
            })
        },
        methods:{
            ...mapActions({
                updateOneBrand : 'admin/updateOneBrand'
            }),
            formSubmit(e) {
                e.preventDefault();
                let myHeaders = new Headers();
                myHeaders.append("Content-Type", "multipart/form-data");

                let formData = new FormData()
                formData.append('name',this.getterEditionBrand.name)
                formData.append('description',this.getterEditionBrand.description)

                if (this.editForm.banner !==null)
                    formData.append('banner',this.editForm.banner)

                if (this.editForm.icone !==null)
                    formData.append('image',this.editForm.icone)

                const config = Object.assign({
                    method:'post',
                    url:"/api/auth/updateBrand/"+this.getterEditionBrand.id,
                    data: formData,
                    headers: myHeaders
                });
                this.updateOneBrand(config)
                setTimeout(() =>{
                    if (this.alertMsg.type) {
                        if (this.alertMsg.type === 1) {
                            this.editForm.icone = null
                            this.editForm.banner = null
                        }
                    }
                },3500)
            },
        }
    }
</script>
<style lang="scss" scoped>
    .widthCustom{
        width: 15%;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>