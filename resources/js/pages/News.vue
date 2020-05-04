<template>
    <div>
        <publicNav></publicNav>
        <section class="allNews">
            <div class="oneNew">
                <router-link to="#">
                    <div>
                        <img src="https://cdn-media.rtl.fr/online/image/2019/0116/7796245819_la-nike-adapt-bb-utilise-un-petit-moteur-pour-ajuster-le-serrage-de-la-chaussure-en-fonction-de-la-forme-du-pied.jpg" alt="">
                    </div>
                    <div>
                        <h2>Nike adapt BB</h2>
                        <p><em>Auteur D.Ace</em></p>
                        <p class="summary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda beatae consequatur cupiditate deserunt ea explicabo incidunt labore perferendis quam quo saepe sapiente, sint sit sunt, temporibus unde velit, voluptas.</p>
                    </div>
                    <div class="moreDetail">
                        <button>Lire la suite</button>
                    </div>
                </router-link>
            </div>
            <div class="oneNew">
                <a href="#">
                    <div>
                        <img src="https://www.lesitedelasneaker.com/wp-content/images/2019/12/nike-colin-kaepernick-air-force-1-low-1100x733.jpg" alt="">
                    </div>
                    <div>
                        <h2>Nike adapt BB</h2>
                        <p><em>Auteur D.Ace</em></p>
                        <p class="summary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda beatae consequatur cupiditate deserunt ea explicabo incidunt labore perferendis quam quo saepe sapiente, sint sit sunt, temporibus unde velit, voluptas.</p>
                    </div>
                </a>
            </div>
            <div class="oneNew">
                <a href="#">
                    <div>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRPYbwFboGy6LpRXUdcyqP-L8fCQREs3Jute6B4lMoQt9p6T1Kb&usqp=CAU" alt="">
                    </div>
                    <div>
                        <h2>Nike adapt BB</h2>
                        <p><em>Auteur D.Ace</em></p>
                        <p class="summary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda beatae consequatur cupiditate deserunt ea explicabo incidunt labore perferendis quam quo saepe sapiente, sint sit sunt, temporibus unde velit, voluptas.</p>
                    </div>
                </a>
            </div>
            <div class="oneNew">
                <a href="#">
                    <div>
                        <img src="https://www.lesitedelasneaker.com/wp-content/images/2019/12/nike-colin-kaepernick-air-force-1-low-1100x733.jpg" alt="">
                    </div>
                    <div>
                        <h2>Nike adapt BB</h2>
                        <p><em>Auteur D.Ace</em></p>
                        <p class="summary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda beatae consequatur cupiditate deserunt ea explicabo incidunt labore perferendis quam quo saepe sapiente, sint sit sunt, temporibus unde velit, voluptas.</p>
                    </div>
                </a>
            </div>
            <div class="oneNew">
                <a href="#">
                    <div>
                        <img src="https://cdn-media.rtl.fr/online/image/2019/0116/7796245819_la-nike-adapt-bb-utilise-un-petit-moteur-pour-ajuster-le-serrage-de-la-chaussure-en-fonction-de-la-forme-du-pied.jpg" alt="">
                    </div>
                    <div>
                        <h2>Nike adapt BB</h2>
                        <p><em>Auteur D.Ace</em></p>
                        <p class="summary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda beatae consequatur cupiditate deserunt ea explicabo incidunt labore perferendis quam quo saepe sapiente, sint sit sunt, temporibus unde velit, voluptas.</p>
                    </div>
                </a>
            </div>
        </section>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    export default {
        name:'news',
        components:{
            publicNav
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