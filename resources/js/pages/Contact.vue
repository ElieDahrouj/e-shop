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
                            <input :class='{ "error" : $v.contactForm.$error}' type="text" v-model.trim="$v.contactForm.firstName.$model" id="name" placeholder="Ex: Mika">
                        </div>
                        <div>
                            <label for="nickname">Prénom</label>
                            <input :class='{ "error" : $v.contactForm.lastName.$error }' type="text" v-model.trim="$v.contactForm.lastName.$model" id="nickname" placeholder="Ex: McDonald">
                        </div>
                    </div>

                    <label for="mail">Email</label>
                    <input :class='{ "error" : $v.contactForm.mail.$error }' type="email" v-model.trim="$v.contactForm.mail.$model" id="mail" placeholder="Ex: mail@gmail.com">

                    <label for="subject">Objet</label>
                    <input :class='{ "error" : $v.contactForm.subject.$error }' type="text" v-model.trim="$v.contactForm.subject.$model" id="subject" placeholder="Objet du mail">

                    <label for="message">Message</label>
                    <textarea :class='{ "error" : $v.contactForm.message.$error }' rows="4" v-model.trim="$v.contactForm.message.$model" id="message" placeholder="Votre message"></textarea>

                    <transition name="fade">
                        <span class="text-danger mt-1" v-if="this.msg"><b>{{msg}}</b></span>
                    </transition>

                    <transition name="fade">
                        <span class="text-success mt-1" v-if="getterMsg"><b>{{getterMsg}}</b></span>
                    </transition>

                    <div class="btnCustom">
                        <button @click="sendContactForm" class="rounded">Envoyer</button>
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
    import { required, email } from 'vuelidate/lib/validators'
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name:'contact',
        data(){
          return {
              msg:null,
              contactForm:{
                  firstName:null,
                  lastName:null,
                  mail:null,
                  subject:null,
                  message:null,
              }
          }
        },
        validations: {
            contactForm: {
                firstName:{
                    required
                },
                lastName:{
                    required
                },
                mail:{
                    required,
                    email
                },
                subject:{
                    required
                },
                message:{
                    required
                },
            }
        },
        components:{
            publicNav
        },
        computed:{
            ...mapGetters(['getterMsg'])
        },
        methods:{
            ...mapActions(['sendMessageFromContact']),
            sendContactForm(){
                this.$v.contactForm.$touch()
                if (this.$v.$invalid) {
                    this.msg = "Tous les champs sont obligatoire"
                }
                else {
                    this.msg = null
                    this.sendMessageFromContact(this.contactForm)

                    this.contactForm.firstName = null
                    this.contactForm.lastName = null
                    this.contactForm.mail = null
                    this.contactForm.subject = null
                    this.contactForm.message = null
                    setTimeout(()=>{
                        let name = document.getElementById("name");
                        name.classList.remove("error");
                        let lastname = document.getElementById("nickname");
                        lastname.classList.remove("error");
                        let mail = document.getElementById("mail");
                        mail.classList.remove("error");
                        let subject = document.getElementById("subject");
                        subject.classList.remove("error");
                        let msg = document.getElementById("message");
                        msg.classList.remove("error");
                    },0)
                }
            }
        }
    }
</script>
<style scoped lang="scss">
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    .error{
        border: 1px solid #b90000 !important;
    }
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
            height: 510px;
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
                height:100%;
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