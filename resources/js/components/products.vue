<template>
    <section class="allProduct">
        <div v-for="allProduct in allSneakers" :key="allProduct.id" class="product">
            <router-link :to="{ name: 'sneaker', params: { id: allProduct.id }}">
                <div>
                    <img :src="allProduct.image" alt="">
                </div>
                <div>
                    <p>{{allProduct.name}}</p>
                    <p>{{allProduct.price}} €</p>
                </div>
            </router-link>
        </div>
    </section>
</template>
<script>
    export default {
        name:'products',
        props:{
            allSneakers:Array
        }
    }
</script>
<style scoped lang="scss">
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
    @media all and (max-width: 769px) {
        .allProduct {
            .product {
                &:hover {
                    transform: scale(1);
                }
            }
        }
    }
    @media all and (max-width: 545px) {
        .allProduct {
            grid-template-columns: repeat(auto-fit, 90%);
        }
    }
</style>