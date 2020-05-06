<template>
    <ul>
        <template v-if=authentificated>
            <li>
                <b>Utilisateur : </b>{{user.name}}
            </li>
            <li>
                <button class="logOut" @click.prevent="signOutAction">Logout</button>
            </li>
        </template>
        <template v-else>
            <li>
                <router-link :to="{name:'admin.home'}">Home</router-link>
            </li>
            <li>
                <router-link :to="{name:'admin.login'}">Login</router-link>
            </li>
        </template>
    </ul>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    export default {
        computed:{
            ...mapGetters({
                authentificated:'auth/authentificated',
                user: 'auth/user'
            })
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
ul{
    padding: 0;
    display: flex;
    list-style: none;
    margin: 10px 0;
    align-items: center;
    justify-content: center;
    li{
        a{
            text-decoration : none;
            color:black;
            padding-bottom: 8px;
            &:hover{
                border-bottom: 1px solid darkblue;
            }
        }
    }
    & li:nth-child(2){
        margin-left: 20px;
    }
    .logOut{
        border-radius: 3px;
        border: 1px solid #c73f4c;
        background-color: #dc3546;
        color: whitesmoke;
        padding: 3px;
        outline:none;
        transition: 0.3s;
        &:hover{
            background-color:#f7d7da;
            color: #7d3f46;
            border: 1px solid #f7d7da;
        }
    }
}
</style>
