<template>

    <div>
        <b-navbar type="dark" variant="dark">
            <b-navbar-nav>
                <b-nav-item href="#">Home</b-nav-item>

                <!-- Navbar dropdowns -->
                <b-nav-item-dropdown text="Lang" right>
                    <b-dropdown-item href="#">EN</b-dropdown-item>
                    <b-dropdown-item href="#">ES</b-dropdown-item>
                    <b-dropdown-item href="#">RU</b-dropdown-item>
                    <b-dropdown-item href="#">FA</b-dropdown-item>
                </b-nav-item-dropdown>

                <b-nav-item-dropdown text="User" right>
                    <b-dropdown-item href="#">Account</b-dropdown-item>
                    <b-dropdown-item href="#">Settings</b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-navbar>
    </div>
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
