<template>
    <div>
        <publicNav></publicNav>
        <header class="preview">
            <div>
                <img src="../assets/bannerHome.jpg" alt="">
                <img src="../assets/mobile.png" alt="">
            </div>
        </header>
        <productsComponent :allSneakers="dataProducts" />
        <div class="newSection">
            <h2>Actualités</h2>
        </div>
        <section class="news">
            <article v-for="fiveNews in getterNews" :key="fiveNews.id">
                <div>
                    <div>
                        <h3>{{fiveNews.title}}</h3>
                        <span><em>Date de publication: {{configDateTime(fiveNews.release_date)}}</em></span>
                    </div>
                    <p>
                        {{fiveNews.summary}}
                    </p>
                    <router-link :to="{ name: 'new', params: { id: fiveNews.id }}"><button>Lire l'article</button></router-link>
                </div>
                <div>
                    <img :src="fiveNews.image" alt="">
                </div>
            </article>
        </section>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    import productsComponent from '../components/products'
    import {mapActions, mapGetters} from 'vuex'
    export default {
        components:{
            publicNav,
            productsComponent
        },
        computed:{
            ...mapGetters(['getterNews','dataProducts']),
        },
        methods:{
            ...mapActions(['homePage']),
            configDateTime(date) {
                return this.$moment(date).locale('fr').format('L')
            },
        },
        beforeMount(){
            this.homePage()
        }
    }
</script>
<style lang="scss">
    .preview{
        div{
            img:nth-child(1){
                width: 100%;
                display: block;
            }
            img:nth-child(2){
                display: none;
                width: 100%;
            }
        }
    }
    .newSection{
        text-align: center;
        font-weight: bold;
        text-decoration:underline;
    }
    .news{
        margin: 15px auto;
        display: grid;
        justify-content: center;
        grid-gap: 50px;
        grid-template-columns: repeat(auto-fit, 750px);
        article{
            display: flex;
            padding: 10px;
            border-radius:6px;
            background-color: #191919;
            div:nth-child(1){
                width: 400px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items:flex-start;
                div:nth-child(1){
                    h3{
                        color: #60837f;
                    }
                    span{
                        color: #60837f;
                    }
                }
                p{
                    color: #d4d6d5;
                    padding-right: 15px;
                }
                button{
                    border-radius: 3px;
                    padding: 10px;
                    border: 1px solid #ecedef;
                    outline: none;
                    background: transparent;
                    font-weight: bold;
                    color: #ecedef;
                    &:hover{
                        background-color: #ecedef;
                        color: #191919;
                    }
                }
            }
            div:nth-child(2){
                width: 600px;
                text-align: center;
                img{
                    max-width: 100%;
                    border-radius:6px
                }
            }
        }
    }
    @media all and (max-width: 769px) {
        .news{
            grid-template-columns: none;
            article{
                flex-direction: column-reverse;
                div:nth-child(1) {
                    div:nth-child(1) {
                        margin-top: 5px;
                        h3 {
                            margin: 0;
                        }
                        span {
                            margin-bottom: 10px;
                        }
                    }
                }
                div:nth-child(2){
                    width:400px;
                }
            }
        }
    }
    @media all and (max-width: 545px) {
        .preview{
            div{
                img:nth-child(1){
                    width: 100%;
                    display: none;
                }
                img:nth-child(2){
                    width: 100%;
                    display: block;
                }
            }
        }
    }
    @media all and (max-width: 426px) {
        .news{
            grid-template-columns: repeat(auto-fit, 95%);
            article{
                div:nth-child(1){
                    width: 100%;
                    p{
                        padding-right:0;
                    }
                }
                div:nth-child(2){
                    width:100%;
                }
            }
        }
    }
</style>