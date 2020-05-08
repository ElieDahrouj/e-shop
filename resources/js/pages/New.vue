<template>
    <div>
        <publicNav></publicNav>
        <section v-if="Object.keys(oneDataProduct).length !== 0" class="new">
            <h1><b>{{oneDataProduct.title}}</b></h1>
            <img :src="oneDataProduct.image" alt="">
            <p><em>Publié {{configDateTime(oneDataProduct.release_date)}} par {{oneDataProduct.user.name}}</em></p>
            <p><em>{{oneDataProduct.summary}}</em></p>
            <p>{{oneDataProduct.content}}</p>
        </section>
        <div v-else class="alert alert-danger mt-5 container"  role="alert">
            Cet article n'existe pas, nous sommes désolé !
        </div>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name:'new',
        components:{
            publicNav
        },
        computed:{
            ...mapGetters(['oneDataProduct'])
        },
        methods:{
            ...mapActions(['oneNew']),
            configDateTime(date) {
                return this.$moment(date).startOf('day').locale('fr').fromNow();
            },
        },
        beforeMount(){
          this.oneNew(this.$route.params.id)
        }
    }
</script>
<style scoped lang="scss">
    .new{
        width: 85%;
        margin: 20px auto;
        h1{
            text-align:center;
        }
        img{
            margin-bottom: 5px;
            padding: 0 150px;
            width: 100%;
        }
        p{
            text-align: justify;
        }
    }
    @media all and (max-width: 769px) {
        .new{
            img{
                padding: 0;
            }
        }
    }
</style>