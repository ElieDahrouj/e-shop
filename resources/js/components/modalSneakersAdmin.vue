<template>
    <b-modal id="bv-modal-sneakers" hide-footer>
        <template v-slot:modal-title>Ajouter une paire de sneaker</template>
        <form @submit="formSubmit" enctype="multipart/form-data">
            <b-form-group id="input-group-2" label-for="input-2">
                <div class="mt-2">Titre de la paire: <b class="text-danger">*</b></div>
                <b-form-input id="input-2" v-model="newForm.title" required placeholder="Enter name"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label-for="input-2">
                <div class="mt-2">Coloris: <b class="text-danger">*</b></div>
                <b-form-input id="input-2" v-model="newForm.color" required placeholder="Enter name"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label-for="price">
                <div class="mt-2">Prix: <b class="text-danger">*</b></div>
                <b-form-input type="number" id="price" v-model="newForm.price" required placeholder="Enter number"></b-form-input>
            </b-form-group>

            <div class="mt-2">Description: <b class="text-danger">*</b></div>
            <b-form-textarea id="textarea" v-model="newForm.description" placeholder="Enter description..." rows="3" max-rows="6"></b-form-textarea>

            <div class="mt-2">
                <label for="date">Date de sortie</label><b class="text-danger">*</b>
                <b-form-datepicker id="date" v-model="newForm.releaseDate" class="mb-2"></b-form-datepicker>
            </div>

            <div class="mt-2">Selectionner une image: <b class="text-danger">*</b> <span class="text-info" v-if="newForm.image">{{ newForm.image.name }}</span></div>
            <b-form-file v-model="newForm.image" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>

            <div class="mt-2">Ajouter des images secondaires: <b class="text-danger">*</b> <span class="text-info" v-if="newForm.moreImages.length !==0">{{ lenghtTab }} {{lenghtTab > 1 ? 'images insérés' : 'image inséré'}}</span></div>
            <b-form-file @change="processFile($event)" multiple ref="file-input" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>

            <div class="mt-2">Marque <b class="text-danger">*</b> </div>
            <div>
                <b-form-select id="selectBrand" v-model="newForm.brandSelected">
                    <b-form-select-option value="null">Choissisez</b-form-select-option>
                    <b-form-select-option  v-for="brand in brands" :key="brand.id" :value="JSON.stringify({ id: brand.id, text: brand.name })">{{brand.name}}</b-form-select-option>
                </b-form-select>
            </div>

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

            <div v-if="getterCreateLoaderProduct" class="d-flex justify-content-start align-items-center">
                <div class="loader"></div><p class="textCustom ml-2 m-0 my-2">En attente d'ajout</p>
            </div>
            <div class="d-flex justify-content-between">
                <b-button class="mt-2" type="submit" variant="success">Ajouter</b-button>
                <b-button class="mt-2" @click="resetProductField" variant="dark">Reset</b-button>
            </div>
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
                    color:null,
                    description:null,
                    image :null,
                    actif:null,
                    releaseDate:null,
                    brandSelected:null,
                    price:null,
                    moreImages:[]
                },
                lenghtTab : null,
            }
        },
        computed:{
            ...mapGetters({
                alertMsg: 'admin/getterMsg',
                brands :  'admin/getterBrandsSelect',
                getterCreateLoaderProduct:'admin/getterCreateLoaderProduct'
            })
        },
        methods:{
            ...mapActions({
                createSneakers : 'admin/createSneaker',
                brandsDisplay: 'admin/displayBrandInSelect'
            }),
            formSubmit(e) {
                e.preventDefault();

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                const brandInfo =JSON.parse(this.newForm.brandSelected)
                let formData = new FormData();
                formData.append('image', this.newForm.image);
                formData.append('name', this.newForm.title);
                formData.append('color', this.newForm.color);
                formData.append('price', this.newForm.price);
                formData.append('description', this.newForm.description);
                formData.append('actif', this.newForm.actif);
                formData.append('release_date', this.newForm.releaseDate);

                if (this.newForm.brandSelected !==null) {
                    formData.append('brand_id', brandInfo.id);
                    formData.append('brand', brandInfo.text);
                }

                for (let i = 0; i <= this.newForm.moreImages.length; i++) {
                    formData.append('moreImages[]', this.newForm.moreImages[i]);
                }

                this.createSneakers(formData,config)
            },
            resetProductField(){
                this.newForm.image = null
                this.newForm.title = null
                this.newForm.price = null
                this.newForm.color = null
                this.newForm.description = null
                this.newForm.releaseDate = null
                this.newForm.actif = null
                this.newForm.brandSelected = null
                this.newForm.moreImages = []
                this.$refs['file-input'].reset()
            },
            processFile(event) {
                let selectedFiles = event.target.files
                for (let i = 0; i < selectedFiles.length; i++)
                {
                    this.newForm.moreImages.push(selectedFiles[i])
                }
                this.lenghtTab = this.newForm.moreImages.length
            }
        },
        mounted(){
            this.brandsDisplay()
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