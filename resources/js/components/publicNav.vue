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
                        <router-link :to="{name:'shoppingCart'}">Panier</router-link>
                    </li>
                    <li class="research">
                        <font-awesome-icon class="search" :icon="['fas', 'search']" />
                        <input type="search" name="search" />
                    </li>
                </ul>
            </div>
        </nav>
        <nav @click="modalMobile" class="mobile">
            <div>
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
                    <li>
                        <router-link :to="{name:'shoppingCart'}">Panier</router-link>
                    </li>
                    <li class="research">
                        <font-awesome-icon class="search" :icon="['fas', 'search']" />
                        <input type="search" name="search" />
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>
<script>
    export default {
        name:'publicNav',
        data(){
            return{
                status:false,
            }
        },
        methods:{
            modalMobile(){
                this.status = true
            },
            leaveModal(){
                this.status = !this.status
            }
        }
    }
</script>
<style scoped lang="scss">
    .mobile{
        display: none;
        div{
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
                    padding-bottom: 5px;
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
                    &:hover{
                        &:not(:last-child){
                            border-bottom: 1px solid red;
                        }
                    }
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
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
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