<template>
    <div>
        <header id="header" class="container">
            <navigation></navigation>
        </header>
        <div class="container custom mb-4 mt-4">
            <div v-for="news in adminNews " :key="news.id" class="card">
                <img :src="news.image" class="card-img-top" alt="...">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h4>{{news.title}}</h4>
                    <b>{{changeDate(news.release_date)}}</b>
                    <p><em>{{news.summary}}</em></p>
                    <p class="card-text">{{news.content}}</p>
                    <div class="d-flex justify-content-between mt-2">
                        <p class="card-text m-0">
                            <button class="btn btn-danger" :value="news.id"><font-awesome-icon class="search" :icon="['fas', 'trash']" /></button>
                        </p>
                        <p class="card-text m-0">
                            <button class="btn btn-light" :value="news.id"><font-awesome-icon class="search" :icon="['fas', 'pen']" /></button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import navigation from '../../components/Navigation'
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name:'managementBrand',
        components:{
            navigation,
        },
        computed:{
            ...mapGetters({
                adminNews : 'admin/getterArray'
            })
        },
        methods:{
            ...mapActions({
                displayNews : 'admin/adminNews'
            }),
            changeDate(data){
                return this.$moment(data).locale('fr').format('L')
            }
        },
        mounted(){
            if (!localStorage.getItem('token')){
                this.$router.replace({name:'admin.home'})
            }
            else{
                this.displayNews()
            }
        }
    }
</script>
<style scoped lang="scss">
    .custom{
        display: grid;
        justify-content: center;
        grid-gap: 50px;
        grid-template-columns: repeat(auto-fit, 275px);
    }
    .card-text{
        white-space: nowrap;
        overflow: hidden;
        margin: 0;
        color: #161616;
        text-overflow: ellipsis;
    }
    .card{
        position: relative;
        top:0;
        transition: top 0.2s ease-in;
        &:hover{
            box-shadow: 0 5px 16px 0 RGBA(0, 0, 0, 0.12);
            top: -5px;
        }
    }
</style>