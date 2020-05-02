<template>
    <div>
        <publicNav></publicNav>
        <section class="formContact">
            <div class="backgroundInfo">
                <div>
                    <h3>Informations Complémentaires</h3>
                    <p><b>19 rue Yves Toudic 75010 Paris</b></p>
                    <a href="tel:+33142419776">01 42 41 97 76</a>
                    <a href="mailto:contact@ecole-webstart.com">contact@ecole-webstart.com</a>
                </div>

            </div>
            <div class="contact">
                <h3><em>Contactez-nous !</em></h3>
                <div class="message">
                    <div class="firstField">
                        <div>
                            <label for="name">Nom</label>
                            <input type="text" id="name" placeholder="Ex: Mika" required>
                        </div>
                        <div>
                            <label for="nickname">Prénom</label>
                            <input type="text" id="nickname" placeholder="Ex: McDonald" required>
                        </div>
                    </div>

                    <label for="mail">Email</label>
                    <input type="email" id="mail" placeholder="Ex: mail@gmail.com" required>

                    <label for="subject">Objet</label>
                    <input type="text" id="subject" placeholder="Subject" required>

                    <label for="message">Message</label>
                    <textarea rows="4" required id="message">Votre message</textarea>
                    <div class="btnCustom">
                        <button class="rounded">Envoyer</button>
                    </div>
                </div>
            </div>
        </section>
        <div class="maps">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.355723921852!2d2.3616560780089193!3d48.8704948933581!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e0950555883%3A0x25e6ea66d950d9ec!2s19%20Rue%20Yves%20Toudic%2C%2075010%20Paris!5e0!3m2!1sfr!2sfr!4v1588177807488!5m2!1sfr!2sfr" width="100%" height="200"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
            </iframe>
        </div>
    </div>
</template>
<script>
    import publicNav from "../components/publicNav"
    export default {
        name:'contact',
        components:{
            publicNav
        }
    }
</script>
<style scoped lang="scss">
    .maps{
        width: 90%;
        margin: auto;
        max-width: 1500px;
    }
    .formContact{
        max-width: 1500px;
        width: 90%;
        display: flex;
        justify-content: space-between;
        margin: 20px auto;
        .backgroundInfo{
            background: url("../assets/shop.jpg")no-repeat;
            width:500px;
            background-size: cover;
            div:nth-child(1){
                display: flex;
                padding: 10px;
                flex-direction: column;
                height: 100%;
                justify-content: space-evenly;
                align-items: center;
                background-color: RGBA(56, 74, 181, 0.8);
                color:whitesmoke;
                p, h3{
                    text-align: center;
                    margin: 0;
                }
                a{
                    color:whitesmoke;
                    font-weight:bold;
                }
            }
        }
        .contact{
            margin:0 10px;
            width:40%;
           .message{
               display: flex;
               flex-direction: column;
               input{
                   margin-bottom: 10px;
               }
               input,textarea{
                   border-radius: 3px;
                   border:1px solid #e5e5e5;
                   padding: 5px;
                   outline: none;
                   &:focus{
                       border:1px solid #333333;
                   }
               }
               .firstField{
                   display: flex;
                   justify-content: space-between;
                   align-items: center;
                   flex-wrap: wrap;
                   div{
                       display:flex;
                       flex-direction: column;
                   }
               }
               .btnCustom{
                   margin-top:10px;
                   button{
                       padding: 8px 20px;
                       color:#376242;
                       background-color: #d4edda;
                       border:1px solid #cae6d0;
                       outline:none;
                       &:hover{
                           color: #fff;
                           background-color: #218838;
                       }
                   }
               }
           }
        }
    }
    @media all and (max-width: 985px) {
        .formContact{
            .contact{
                .message{
                    .firstField{
                        display:block;
                    }
                }
            }
        }
    }
    @media all and (max-width: 769px) {
        .maps{
            width: 100%;
        }
        .formContact{
            width: 100%;
            margin: 0;
            flex-direction: column;
            align-items: center;
            .backgroundInfo{
                width: 100%;
                div:nth-child(1){
                    height: 320px;
                }
            }
            .contact{
                width:75%;
                margin: 20px 0;
            }
        }
    }
    @media all and (max-width: 321px) {
        .backgroundInfo{
            div:nth-child(1){
                h3{
                    font-size: 20px;
                }
            }
        }
    }
</style>