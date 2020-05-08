<template>
    <div>
        <publicNav></publicNav>
        <section class="allNews">
            <div v-for="eachNew in getterNews" :key="eachNew.id" class="oneNew">
                <router-link :to="{ name: 'new', params: { id: eachNew.id }}">
                    <div>
                        <img :src="eachNew.image" alt="">
                    </div>
                    <div>
                        <h2>{{eachNew.title}}</h2>
                        <p><em>{{configDateTime(eachNew.release_date)}}</em></p>
                        <p class="summary">{{eachNew.summary}}</p>
                    </div>
                    <div class="moreDetail">
                        <button>Lire la suite</button>
                    </div>
                </router-link>
            </div>
        </section>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name:'news',
        components:{
            publicNav
        },
        computed:{
            ...mapGetters(['getterNews']),

        },
        methods:{
            ...mapActions(['allNews']),
            configDateTime(date) {
                return this.$moment(date).locale('fr').format('L')
            },
        },
        beforeMount(){
            this.allNews()
        }
    }
</script>
<style scoped lang="scss">
    .allNews{
        display: grid;
        grid-gap: 46px;
        justify-content: center;
        grid-template-columns: repeat(auto-fit, 300px);
        margin: 20px 0;
        .oneNew{
            border-radius:3px ;
            margin: 5px;
            top: 0;
            transition: top .2s ease-in;
            position:relative;
            a{
                text-decoration:none;
                div:nth-child(1){
                    img{
                        width:100%;
                        border-radius:3px 3px 0 0;
                        height: 130px;
                        object-fit: cover;
                    }
                }
                div:nth-child(2){
                    padding:10px;
                    h2{
                        font-size:20px;
                        color: #161616;
                        margin: 0;
                    }
                    p{
                        em{
                            color:#b8bdc8;
                        }
                    }
                    .summary{
                        white-space: nowrap;
                        overflow: hidden;
                        margin:0;
                        color:#161616;
                        text-overflow: ellipsis;
                    }
                }
            }
            &:hover{
                box-shadow: 0 5px 16px 0 RGBA(0,0,0,0.12);
                top: -5px;
            }
            .moreDetail{
                border-radius: 3px;
                opacity: 0;
                position: absolute;
                top: 0;
                height: 100%;
                width: 100%;
                display:flex;
                background: rgba(0,138,164,.85);
                justify-content: center;
                align-items: center;
                &:hover{
                    opacity: 1;
                    transition: all .10s ease-in-out;
                }
                button{
                    padding: 10px;
                    border-radius: 6px;
                    background-color: transparent;
                    border: 1px solid whitesmoke;
                    font-weight: bold;
                    color: white;
                    &:hover{
                        background-color: whitesmoke;
                        color:rgb(0,138,164) ;
                        font-weight: bold;
                        transition: all .10s ease-in-out;
                    }
                }
            }
        }
    }
    @media all and (max-width: 769px) {
        .allNews{
            .oneNew{
                position: static;
                .moreDetail{
                    display: none;
                }
            }
        }
    }
    @media all and (max-width: 460px) {
        .allNews{
            flex-direction: column;
            align-items: center;
            .oneNew{
                &:not(:last-child){
                    margin-bottom: 25px;
                    border-radius: 3px 3px 0 0;
                    border-bottom: 1px solid black;
                }
            }
        }
    }
</style>