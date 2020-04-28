<template>
    <div>
        <header id="header" class="container">
            <navigation></navigation>
        </header>
        <div class="container mt-4" style="max-width: 600px">
            <div class="card card-default">
                <div class="card-header">Connexion</div>
                <div class="card-body">
                    <form autocomplete="off" @submit.prevent="login" method="post">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="form.email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" class="form-control" v-model="form.password" required>
                        </div>
                        <button type="submit" class="btn btn-success">Connexion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import navigation from '../../components/Navigation'
    import {mapActions} from 'vuex'
    export default {
        name:'login',
        components:{
            navigation
        },
        data(){
            return{
                form:{
                    email:null,
                    password:null
                }
            }
        },
        methods:{
            ...mapActions({
                signIn:'auth/login'
            }),
            login(){
                this.signIn(this.form)
                    .then(() => {
                        this.$router.replace({name:'admin.dashboard'})
                    })
            }
        }
    }
</script>