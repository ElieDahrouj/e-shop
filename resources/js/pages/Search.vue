<template>
    <div>
        <publicNav></publicNav>
        <div v-if="dataProducts.length !== 0">
            <productsComponent :allSneakers="dataProducts" />
            <div class="endPage">
                <div class="pagination">
                    <button @click="paginationPage(1)"  :disabled="oneDataProduct.current_page === 1">
                        <font-awesome-icon class="search" :icon="['fas', 'angle-double-left']" />
                    </button>

                    <button @click="previous(oneDataProduct)"  :disabled="oneDataProduct.current_page === oneDataProduct.from">
                        <font-awesome-icon class="search" :icon="['fas', 'chevron-left']" />
                    </button>

                    <span><b>{{oneDataProduct.current_page}} / {{oneDataProduct.last_page}}</b></span>

                    <button @click="nextPage(oneDataProduct)" :disabled="oneDataProduct.current_page === oneDataProduct.last_page">
                        <font-awesome-icon class="search" :icon="['fas', 'chevron-right']" />
                    </button>

                    <button @click="paginationPage(oneDataProduct.last_page)"  :disabled="oneDataProduct.current_page === oneDataProduct.last_page">
                        <font-awesome-icon class="search" :icon="['fas', 'angle-double-right']" />
                    </button>
                </div>
            </div>
        </div>
        <p v-else class="text-danger text-center display-4 mt-4 customSize">Aucun résultat !</p>
    </div>
</template>
<script>
    import publicNav from '../components/publicNav'
    import productsComponent from '../components/products'
    import {mapGetters,mapActions} from 'vuex'
    export default {
        name:'Search',
        components:{
            publicNav,
            productsComponent
        },
        computed:{
            ...mapGetters(['dataProducts','oneDataProduct']),
        },
        methods:{
            ...mapActions(['paginationPage']),
            nextPage(data){
                this.paginationPage(data.current_page += 1)
            },
            previous(data){
                this.paginationPage(data.current_page -= 1)
            }
        },
    }
</script>
<style scoped lang="scss">
    .customSize{
        font-size: 2.5em;
    }
    .endPage {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top:30px;
        .pagination {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #ecedef;
            justify-content: space-around;
            button, span {
                margin: 0 10px;
            }
            button {
                background-color: #60837f;
                color: whitesmoke;
                border: 1px solid #60837f;
                border-radius: 10px;
                padding: 7px 15px;
                outline: none;
                &:hover{
                    background-color: #719a95;
                }
                &:disabled{
                    color: #bebebe;
                    background-color: #F9F9FC;
                    border: 1px solid #F9F9FC;
                }
            }
        }
    }
    @media all and (max-width: 769px) {
        .endPage{
            .pagination{
                width: 100%;
            }
        }
    }
</style>