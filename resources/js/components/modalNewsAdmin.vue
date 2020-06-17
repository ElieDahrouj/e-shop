<template>
    <b-modal id="bv-modal-news" hide-footer>
        <template v-slot:modal-title>Ajouter une actualité</template>
        <form @submit="formSubmit" enctype="multipart/form-data">
            <b-form-group id="input-group-2" label-for="input-2">
                <div class="mt-2">Nom de l'actualité: <b class="text-danger">*</b></div>
                <b-form-input id="input-2" v-model="newForm.title" required placeholder="Enter name"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label-for="input-2">
                <div class="mt-2">Sommaire: <b class="text-danger">*</b></div>
                <b-form-input id="input-2" v-model="newForm.sommaire" required placeholder="Enter name"></b-form-input>
            </b-form-group>

            <b-form-textarea class="mt-3" id="textarea" v-model="newForm.description" placeholder="Enter something..." rows="3" max-rows="6"></b-form-textarea>

            <div class="mt-2">
                <label for="date">Date de sortie</label><b class="text-danger">*</b>
                <b-form-datepicker id="date" v-model="newForm.releaseDate" class="mb-2"></b-form-datepicker>
            </div>

            <div class="mt-2">Selectionner une image: <b class="text-danger">*</b> <span class="text-info" v-if="newForm.image">{{ newForm.image.name }}</span></div>
            <b-form-file v-model="newForm.image" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>

            <div class="mt-2">Publiée ou non <b class="text-danger">*</b> </div>
            <div>
                <b-form-select v-model="newForm.actif">
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
                newForm:{
                    title:null,
                    sommaire:null,
                    description:null,
                    image :null,
                    actif:null,
                    releaseDate:null,
                    user_id:null
                }
            }
        },
        computed:{
            ...mapGetters({
                alertMsg: 'admin/getterMsg',
            })
        },
        methods:{
            ...mapActions({
                createNews : 'admin/createNews'
            }),
            formSubmit(e) {
                e.preventDefault();

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                const user = JSON.parse(localStorage.getItem('user'))
                let formData = new FormData();
                formData.append('image', this.newForm.image);
                formData.append('title', this.newForm.title);
                formData.append('summary', this.newForm.sommaire);
                formData.append('description', this.newForm.description);
                formData.append('actif', this.newForm.actif);
                formData.append('release_date', this.newForm.releaseDate);
                formData.append('user_id', user.id);
                this.createNews(formData,config)

                setTimeout(() =>{
                    if (this.alertMsg.type){
                        if (this.alertMsg.type === 1) {
                            this.newForm.image = null
                            this.newForm.title = null
                            this.newForm.sommaire = null
                            this.newForm.description = null
                            this.newForm.releaseDate = null
                            this.newForm.actif = null
                        }
                    }
                },2500)
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