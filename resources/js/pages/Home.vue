<template>
    <div>
        <publicNav></publicNav>
        <header class="preview">
            <div>
                <img src="../assets/sport.jpg" alt="">
                <img src="../assets/mobile.png" alt="">
            </div>
        </header>
        <section class="allProduct">
            <div v-for="tenProductRandom in tenDataRandom" :key="tenProductRandom.id" class="product">
                <router-link :to="{ name: 'sneaker', params: { id: tenProductRandom.id }}">
                    <div>
                        <img :src="tenProductRandom.image" alt="">
                    </div>
                    <div>
                        <p>{{tenProductRandom.name}}</p>
                        <p>{{tenProductRandom.price}} €</p>
                    </div>
                </router-link>
            </div>
        </section>
        <div class="newSection">
            <h2>Actualités</h2>
        </div>
        <section class="news">
            <article v-for="fiveNews in fiveDataNews" :key="fiveNews.id">
                <div>
                    <div>
                        <h3>{{fiveNews.title}}</h3>
                        <span><em>Date de publication: {{configDateTime(fiveNews.created_at)}}</em></span>
                    </div>

                    <p>
                        {{fiveNews.summary}}
                    </p>
                    <button :value="fiveNews.id">Lire l'article</button>
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
    import {mapActions, mapGetters} from 'vuex'
    export default {
        components:{
            publicNav
        },
        computed:{
            ...mapGetters(['fiveDataNews','tenDataRandom']),
        },
        methods:{
            ...mapActions(['homePage','configDateTime']),

        },
        beforeMount(){
            this.homePage()
        }
    }
</script>
<style lang="scss">
    .allProduct{
        display: grid;
        justify-content: center;
        grid-gap: 50px;
        grid-template-columns: repeat(auto-fit, 250px);
        margin: 20px 0;
        .product{
            background-color: #eaeeef;
            padding: 10px;
            border-radius: 3px;
            transition: transform .2s;
            &:hover{
                transform: scale(1.1);

            }
            a {
                text-decoration: none;
                color: #041f54;
                div:nth-child(1) {
                    img {
                        width: 100%;
                        object-fit: cover;
                        max-width: 100%;
                        height: auto;
                    }
                }
                div:nth-child(2) {
                    display: flex;
                    justify-content: space-between;
                    p {
                        margin-top: 10px;
                        margin-bottom: 0;
                    }
                }
            }
        }
    }
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
        .allProduct {
            grid-template-columns: repeat(auto-fit, 320px);
        }
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