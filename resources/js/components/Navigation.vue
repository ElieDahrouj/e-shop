<template>
    <div>
        <b-navbar type="dark" variant="dark" class="mb-4">
            <div class="desktop w-100">
                <b-navbar-nav  class="d-flex justify-content-between align-items-center p-2 w-100">
                    <template v-if=authentificated>
                        <img style="width: 90px" src="../assets/test2.png" alt="">
                        <div class="d-flex justify-content-between align-items-center">
                            <b-nav-item><router-link class="link" :to="{name:'admin.dashboard'}">Accueil</router-link></b-nav-item>
                            <b-nav-item-dropdown text="Ajouter" right>
                                <b-dropdown-item @click="$bvModal.show('bv-modal-brand')">Une marque</b-dropdown-item>
                                <b-dropdown-item @click="$bvModal.show('bv-modal-news')">Une Actualité</b-dropdown-item>
                                <b-dropdown-item @click="$bvModal.show('bv-modal-sneakers')">Une Paire de chaussure</b-dropdown-item>
                            </b-nav-item-dropdown>

                            <b-avatar class="ml-1"></b-avatar>
                            <b-nav-item-dropdown :text="user.name" right>
                                <b-dropdown-item>
                                    <button class="logOut text-danger" @click.prevent="signOutAction">Se deconnecter <font-awesome-icon class="search" :icon="['fas', 'sign-out-alt']" /></button>
                                </b-dropdown-item>
                            </b-nav-item-dropdown>
                        </div>
                    </template>

                    <template v-else>
                        <b-nav-item><router-link class="link" :to="{name:'admin.home'}">Home</router-link></b-nav-item>
                        <b-nav-item><router-link class="link" :to="{name:'admin.login'}">Login</router-link></b-nav-item>
                    </template>
                </b-navbar-nav>
            </div>
            <template v-if="authentificated">
                <div class="mobile">
                    <template v-if="authentificated">
                        <b-navbar-nav  class="d-flex justify-content-end align-items-center w-100 mr-2">
                            <b-avatar class="ml-1"></b-avatar>
                            <b-nav-item-dropdown :text="user.name" right>
                                <b-dropdown-item>
                                    <button class="logOut text-danger" @click.prevent="signOutAction">Se deconnecter <font-awesome-icon class="search" :icon="['fas', 'sign-out-alt']" /></button>
                                </b-dropdown-item>
                            </b-nav-item-dropdown>
                        </b-navbar-nav>
                    </template>

                    <b-button v-b-toggle.sidebar-right>
                        <font-awesome-icon class="search" :icon="['fas', 'bars']" />
                    </b-button>

                    <b-sidebar id="sidebar-right" title="Administration" right shadow backdrop>
                        <div class="img">
                            <img src="../assets/test.png" alt="">
                        </div>
                        <div class="px-3 py-2">
                            <template v-if="authentificated">
                                <div class="mt-2">
                                    <router-link :to="{name:'admin.dashboard'}">
                                        <button class="btn btn-dark">Accueil</button>
                                    </router-link>
                                </div>
                                <div class="mt-2"><button @click="$bvModal.show('bv-modal-brand')" class="btn border btn-light">Ajouter une marque</button></div>
                                <div class="mt-2"><button @click="$bvModal.show('bv-modal-news')" class="btn btn-dark">Ajouter une actualité</button></div>
                                <div class="mt-2"><button @click="$bvModal.show('bv-modal-sneakers')" class="btn btn-light border">Ajouter une chausssure</button></div>
                            </template>
                        </div>
                    </b-sidebar>
                </div>
            </template>

            <template v-else>
                <div class="mobile">
                    <b-navbar-nav  class="d-flex justify-content-between align-items-center w-100">
                        <b-nav-item><router-link class="link" :to="{name:'admin.home'}">Home</router-link></b-nav-item>
                        <b-nav-item><router-link class="link" :to="{name:'admin.login'}">Login</router-link></b-nav-item>
                    </b-navbar-nav>
                </div>
            </template>
        </b-navbar>
        <modalBrand></modalBrand>
        <modalNew></modalNew>
        <modalSneaker></modalSneaker>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import modalBrand from '../components/modalBrandAdmin'
    import modalNew from '../components/modalNewsAdmin'
    import modalSneaker from '../components/modalSneakersAdmin'
    export default {
        computed:{
            ...mapGetters({
                authentificated:'auth/authentificated',
                user: 'auth/user'
            })
        },
        components:{
            modalBrand,
            modalNew,
            modalSneaker
        },
        methods:{
            ...mapActions({
                disconnect : 'auth/signOut'
            }),
            signOutAction(){
                this.disconnect().then(()=>{
                    this.$router.replace({name:'admin.login'})
                })
            }
        }
    }
</script>
<style scoped lang="scss">
    .link{
        color: rgba(255, 255, 255, 0.5);
        text-decoration:none;
        &:hover{
            color: rgba(255, 255, 255, 0.75);
        }
    }
    .logOut{
        border-radius: 3px;
        border: none;
        background-color: transparent;
        padding: 3px;
        outline:none;
        transition: 0.3s;
    }
    .mobile{
        display: none;
    }
    .desktop{
        display: block;
    }
    .img{
        margin-top:10px;
        width:100%;
        text-align:center;
        img{
            width:130px;
        }
    }
    @media all and (max-width: 769px){
        a{
            font-size:20px;
            color: black;
            text-decoration:none;
            &:hover{
                color: gray;
            }
        }
        .mobile{
            display: flex;
            justify-content: flex-end;
            width:100%;
        }
        .desktop{
            display: none;
        }
    }
</style>
