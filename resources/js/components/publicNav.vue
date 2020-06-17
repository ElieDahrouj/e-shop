<template>
    <div class="changePosition">
        <nav class="navBar">
            <div>
               <router-link :to="{name:'home'}"><img src="../assets/test.png" alt=""></router-link>
            </div>
            <div>
                <ul>
                    <li>
                        <router-link :to="{ name: 'catalogue'}">Catalogue</router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'news'}">News</router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'contact'}">Contact</router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'shoppingCart'}">
                            <font-awesome-icon :icon="['fas', 'shopping-cart']" /> {{getterCartLength !==0 ? getterCartLength : ''}}
                        </router-link>
                    </li>
                    <li class="research">
                        <font-awesome-icon class="search" :icon="['fas', 'search']" />
                        <input v-model="filterProducts" @keyup.enter="researchProducts" id="search" type="text" />
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="mobile">
            <div>
                <font-awesome-icon @click="openResearchBar" class="researchMobile" :icon="['fas', 'search']" />
                <input autocomplete="off" v-model="filterProducts" @keyup.enter="researchProducts" type="search" name="search" />
            </div>
            <div>
                <router-link class="text-dark custom" :to="{name:'shoppingCart'}"><font-awesome-icon :icon="['fas', 'shopping-cart']"/> {{getterCartLength !==0 ? getterCartLength : ''}}</router-link>
            </div>
            <div @click="modalMobile">
                <font-awesome-icon :icon="['fas', 'bars']" />
            </div>
        </nav>
        <transition name="slide-fade">
            <div v-if="status" class="navMobile">
                <ul>
                    <li>
                        <font-awesome-icon @click="leaveModal" :icon="['fas', 'times']" />
                    </li>
                    <li>
                        <router-link :to="{name:'home'}"><img src="../assets/test2.png" alt=""></router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'catalogue'}">Catalogue</router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'news'}">News</router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'contact'}">Contact</router-link>
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>
<script>
import {mapActions , mapGetters} from 'vuex'
    export default {
        name:'publicNav',
        data(){
            return{
                status:false,
                filterProducts : null,
                statusSearch:false
            }
        },
        computed:{
            ...mapGetters({
                getterCartLength:'cart/getterCartLength'
            })
        },
        methods:{
            ...mapActions(['searchProducts']),
            ...mapActions({
                getCart:'cart/getCart'
            }),
            modalMobile(){
                this.status = true
            },
            leaveModal(){
                this.status = !this.status
            },
            researchProducts(){
                const path = "/products/search/"+this.strUcFirst(this.filterProducts)
                if (this.$route.path !== path){
                    this.$router.replace({name:'filteredProducts', params:{name:this.strUcFirst(this.filterProducts)}})
                }
                this.searchProducts(this.strUcFirst(this.filterProducts))
                this.status = false
            },
            strUcFirst(a){
                return (a+'').charAt(0).toUpperCase()+a.substr(1);
            },
            openResearchBar(){
                this.statusSearch = !this.statusSearch
                let inputSearch = document.querySelector('input[name=search]')
                let iconeSearch = document.querySelector('.researchMobile')
                inputSearch.classList.add("openResearch")
                iconeSearch.classList.add("stabilisationIcone")
                if (this.statusSearch === false){
                    inputSearch.classList.remove("openResearch")
                    iconeSearch.classList.remove("stabilisationIcone")
                }
            }
        },
        mounted(){
          this.getCart()
        }
    }
</script>
<style scoped lang="scss">
    .custom{
        text-decoration: none;
    }
    .mobile{
        display: none;
        div:nth-child(1){
            position:relative;
            .researchMobile{
                position: absolute;
                font-size: 25px;
                color:#343a40;
            }
            .stabilisationIcone{
                padding-bottom:5px
            }
            .openResearch{
                width: 200px;
                padding-left: 35px;
                border-bottom: 1px solid #343a40;
            }
            input{
                padding-left: 30px;
                outline: none;
                background-color: transparent;
                border: none;
                width: 0;
                transition: width 0.5s ease;
            }
        }
        div:nth-child(2),div:nth-child(3){
            margin: 10px;
            font-size: 25px
        }
        background-color: #e2e2e2;
    }
    .navBar{
        width: 95%;
        margin:5px auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        div:nth-child(1) {
            width: 110px;
            a {
                img {
                    max-width: 100%;
                    height: auto;
                }
            }
        }
        div:nth-child(2){
            ul{
                list-style: none;
                padding: 0;
                display: flex;
                margin: 0;
                justify-content: flex-start;
                li{
                    margin: 0 10px;
                    position: relative;
                    a{
                        color: #07060b;
                        text-decoration: none;
                    }
                    .search{
                        position: absolute;
                        top: 5px;
                        left: 5px;
                    }
                    input{
                        border: 1px solid black;
                        padding-left: 25px;
                        border-radius: 3px;
                    }
                }
                li a::before,
                li a::after{
                    content: '';
                    position: absolute;
                    width: 100%;
                    height: 2px;
                    background-color: crimson;
                    left: 0;
                    transform: scaleX(0);
                    transition: all .5s;
                }
                li a::before{
                    top: 0;
                    transform-origin: left;
                }

                li a::after{
                    bottom: 0;
                    transform-origin: right;
                }
                li a:hover::before,
                li a:hover::after{
                    transform: scaleX(1);
                }
            }
        }
    }
    .navMobile{
        position: absolute;
        top: 0;
        right: 0;
        height: 100vh;
        width: 100vw;
        background-color: RGBA(236, 237, 239,.6);
        display: flex;
        justify-content: flex-end;
        ul{
            list-style: none;
            display: flex;
            flex-direction: column;
            margin: 0;
            height: 100vh;
            justify-content: flex-start;
            align-items: center;
            width: 50%;
            padding:5px;
            background-color: #05286d;
            li:nth-child(1){
                text-align: right;
                font-size: 28px;
                padding: 3px;
                width: 95%;
                color: whitesmoke;
            }
            li:nth-child(2){
                text-align: center;
                padding-bottom: 20px;
                img{
                    width: 65%;
                }
            }
            li{
                padding:10px 0;
                position: relative;
                a{
                    color: whitesmoke;
                    text-decoration: none;
                    padding: 5px;
                    font-size: 15px;
                    font-weight: bold;
                    &:hover{
                       color: #60837f;
                    }
                }
                .search{
                    position: absolute;
                    top: 16px;
                    left: 5px;
                }
                input{
                    border: 1px solid black;
                    padding-left: 25px;
                    border-radius: 3px;
                    width:100%;
                }
            }
        }
    }
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(10px);
        opacity: 0;
    }
    @media all and (max-width: 769px) {
        .navBar{
            display: none;
        }
        .mobile{
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .changePosition{
            position: sticky;
            top: 0;
        }
    }
</style>