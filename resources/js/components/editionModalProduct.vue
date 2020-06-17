<template>
    <b-modal id="bv-modal-sneakersEdition" hide-footer>
        <template v-slot:modal-title>Modification de la paire de sneaker {{getterEditionProduct.name}}</template>
        <form @submit="formSubmit" enctype="multipart/form-data">
            <b-form-group id="input-group-2" label-for="input-2">
                <div class="mt-2">Titre de la paire: <b class="text-danger">*</b></div>
                <b-form-input id="input-2" v-model="getterEditionProduct.name" required placeholder="Enter name"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label-for="input-2">
                <div class="mt-2">Coloris: <b class="text-danger">*</b></div>
                <b-form-input id="input-2" v-model="getterEditionProduct.color" required placeholder="Enter color"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label-for="price">
                <div class="mt-2">Prix: <b class="text-danger">*</b></div>
                <b-form-input type="number" id="price" v-model="getterEditionProduct.price" required placeholder="Enter price"></b-form-input>
            </b-form-group>

            <div class="mt-2">Description: <b class="text-danger">*</b></div>
            <b-form-textarea id="textarea" v-model="getterEditionProduct.description" placeholder="Enter description..." rows="3" max-rows="6"></b-form-textarea>

            <div class="mt-2">
                <label for="date">Date de sortie</label><b class="text-danger">*</b>
                <b-form-datepicker id="date" v-model="getterEditionProduct.release_date" class="mb-2"></b-form-datepicker>
            </div>

            <div class="mt-2">Selectionner une image: <b class="text-danger">*</b> <span class="text-info" v-if="newForm.image">{{ newForm.image.name }}</span></div>
            <b-form-file v-model="newForm.image" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>
            <div class="mt-2 text-info font-weight-bold">Image actuelle:</div>
            <img class="w-100" :src="getterEditionProduct.image" alt="">

            <div class="mt-2">Ajouter des images secondaires: <b class="text-danger">*</b> <span class="text-info" v-if="newForm.moreImages.length !==0">{{ lenghtTab }} {{lenghtTab > 1 ? 'images insérés' : 'image inséré'}}</span></div>
            <b-form-file @change="processFile($event)" multiple ref="file-input" class="nameOfFile" placeholder="Choose a file or drop it here..."></b-form-file>
            <div class="mt-2 text-info font-weight-bold">Images Secondaire actuelle:</div>
            <div class="imageSecond">
                <div class="my-2 mx-2" v-for="imageSecond in getterEditionProduct.images">
                    <button @click="deleteSecondaryPicture(imageSecond.id)"><font-awesome-icon class="search" :icon="['fas', 'times-circle']"/></button>
                    <img class="p-3" :src="imageSecond.image" alt="">
                </div>
            </div>

            <div class="mt-2">Marque<b class="text-danger">*</b> </div>
            <div class="text-info font-weight-bold">Marque Actuellement selectionné: {{getterEditionProduct.brand}}</div>
            <div>
                <b-form-select v-model="newForm.brandSelected">
                    <b-form-select-option value="null">Choissisez</b-form-select-option>
                    <b-form-select-option v-for="brand in brands" :key="brand.id" :value="JSON.stringify({ id: brand.id, text: brand.name })">{{brand.name}}</b-form-select-option>
                </b-form-select>
            </div>

            <div class="mt-2">Publiée ou non <b class="text-danger">*</b> </div>
            <div>
                <b-form-select v-model="getterEditionProduct.actif">
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

            <div v-if="getterLoaderProduct" class="d-flex justify-content-start align-items-center">
                <div class="loader"></div><p class="textCustom ml-2 m-0 my-2">En attente de l'ajout</p>
            </div>

            <b-button class="mt-3" type="submit" variant="success">Modifier</b-button>
        </form>
    </b-modal>
</template>
<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name:'editionModalProduct',
        data(){
            return{
                newForm:{
                    image :null,
                    moreImages:[],
                    brandSelected: null
                },
                lenghtTab : null,
            }
        },
        computed:{
            ...mapGetters({
                alertMsg: 'admin/getterMsg',
                getterEditionProduct : 'admin/getterEditionProduct',
                brands :  'admin/getterBrandsSelect',
                getterLoaderProduct:'admin/getterLoaderProduct'
            })
        },
        methods:{
            ...mapActions({
                updateOneProduct : 'admin/updateOneProduct',
                brandsDisplay: 'admin/displayBrandInSelect',
                deleteSecondaryPicture:'admin/deleteSecondaryPicture'
            }),
            formSubmit(e) {
                e.preventDefault();

                let myHeaders = new Headers();
                myHeaders.append("Content-Type", "multipart/form-data");

                let formData = new FormData();
                formData.append('name', this.getterEditionProduct.name);
                formData.append('color', this.getterEditionProduct.color);
                formData.append('price', this.getterEditionProduct.price);
                formData.append('description', this.getterEditionProduct.description);
                formData.append('actif', this.getterEditionProduct.actif);
                formData.append('release_date', this.getterEditionProduct.release_date);

                if (this.newForm.image !==null) {
                    formData.append('image', this.newForm.image);
                }

                if (this.newForm.brandSelected !==null) {
                    const brandInfo =JSON.parse(this.newForm.brandSelected)
                    formData.append('brand_id', brandInfo.id);
                    formData.append('brand', brandInfo.text);
                }

                if(this.newForm.moreImages.length !== 0){
                    for (let i = 0; i <= this.newForm.moreImages.length; i++) {
                        formData.append('moreImages[]', this.newForm.moreImages[i]);
                    }
                }
                const config = Object.assign({
                    method:'post',
                    url:"/api/auth/updateProduct/"+this.getterEditionProduct.id,
                    data: formData,
                    headers: myHeaders
                });

                this.updateOneProduct(config)

                setTimeout(() => {
                    if (this.alertMsg) {
                        if (this.alertMsg.type === 1) {
                            this.newForm.moreImages = []
                            this.$refs['file-input'].reset()
                        }
                    }
                },6000)
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
    }
</script>
<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    .loader {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid orange;
        border-bottom: 5px solid orange;
        width: 20px;
        height: 20px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .textCustom{
        color:orange;
    }
    .imageSecond{
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        div{
            position: relative;
            width: 45%;
            button{
                font-size:30px;
                position: absolute;
                right: 0;
                color: red;
                background-color: transparent;
                border-radius: 100%;
                border: none;
                outline: none;
            }
            img{
                width: 100%;
            }
        }

    }
</style>