<template>
    <b-modal id="bv-modal-newsEdition" hide-footer>
        <template v-slot:modal-title>Modification d'une actualité</template>
        <div>
            <b-form-group id="input-group-2" label-for="input-2">
                <div class="mt-2">Nom de l'actualité:</div>
                <b-form-input id="input-2" v-model="getterEditionNew.title" required placeholder="Enter title"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label-for="input-2">
                <div class="mt-2">Sommaire: <b class="text-danger">*</b></div>
                <b-form-input id="input-2" v-model="getterEditionNew.summary" required placeholder="Enter summary"></b-form-input>
            </b-form-group>

            <div class="mt-2">Nouvelle Description: <b class="text-danger">*</b></div>
            <b-form-textarea id="textarea" v-model="getterEditionNew.content" placeholder="Enter something..." rows="3" max-rows="6"></b-form-textarea>

            <div class="mt-2">
                <label for="date">Date de sortie</label>
                <b-form-datepicker id="date" v-model="getterEditionNew.release_date" class="mb-2"></b-form-datepicker>
            </div>

            <div class="mt-2">Selectionner une image: <b class="text-danger">*</b> <span class="text-info" v-if="newForm.image">{{ newForm.image.name }}</span></div>
            <b-form-file v-model="newForm.image" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>
            <div class="mt-2 text-info font-weight-bold">Image actuelle:</div>
            <img class="w-100" :src="getterEditionNew.image" alt="">

            <div class="mt-2">Publiée ou non </div>
            <div>
                <b-form-select v-model="getterEditionNew.actif">
                    <b-form-select-option value="0">Non</b-form-select-option>
                    <b-form-select-option value="1">Oui</b-form-select-option>
                </b-form-select>
            </div>

            <transition name="fade">
                <p class="my-2" v-if="alertMsg">
                    <span class="text-danger" v-if="alertMsg.type === 0">{{alertMsg.msg}}</span>
                    <span class="text-success" v-if="alertMsg.type === 1">{{alertMsg.msg}}</span>
                </p>
            </transition>

            <div v-if="getterLoaderUpdateNew" class="d-flex justify-content-start align-items-center">
                <div class="loader"></div><p class="textCustom ml-2 m-0 my-2">Mise à jour en cours</p>
            </div>
            <div class="d-flex justify-content-between">
                <b-button class="mt-3" @click="formSubmit" variant="success">Modifier</b-button>
                <b-button class="mt-3" @click="resetFileField" variant="dark">Reset</b-button>
            </div>
        </div>
    </b-modal>
</template>
<script>
    import {mapGetters, mapActions} from 'vuex'
    export default {
        name:'editionModalNew',
        data(){
            return{
                newForm:{
                    image :null,
                }
            }
        },
        computed:{
            ...mapGetters({
                getterEditionNew:"admin/getterEditionNew",
                alertMsg: 'admin/getterMsg',
                getterLoaderUpdateNew:'admin/getterLoaderUpdateNew'
            })
        },
        methods:{
            ...mapActions({
                updateNew : 'admin/updateNew'
            }),
            formSubmit(e) {
                e.preventDefault();

                let myHeaders = new Headers();
                myHeaders.append("Content-Type", "multipart/form-data");

                let formData = new FormData();
                formData.append("title",this.getterEditionNew.title);
                formData.append("summary",this.getterEditionNew.summary)
                formData.append("release_date",this.getterEditionNew.release_date)
                formData.append("actif",this.getterEditionNew.actif)
                formData.append("description",this.getterEditionNew.content)

                if (this.newForm.image !== null){
                    formData.append('newImage', this.newForm.image);
                }

                const config = Object.assign({
                    method:'post',
                    url:"/api/auth/updateNew/"+this.getterEditionNew.id,
                    data: formData,
                    headers: myHeaders
                });
                this.updateNew(config)
            },
            resetFileField(){
                this.newForm.image = null
            },
        }
    }
</script>
<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>