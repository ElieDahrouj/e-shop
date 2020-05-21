<template>
    <div :class="className">
        <a href="">
            <div>
                <p>{{name}}</p>
            </div>
        </a>
    </div>
</template>
<script>
    export default {
        name:'btnAdmin',
        props:{
            className:String,
            name:String
        }
    }
</script>
<style scoped lang="scss">
   div{
       width: 200px;
       height: 100px;
       display: flex;
       align-items: center;
       justify-content: center;
       background-size: cover;
       background-repeat: no-repeat;
       transition: transform .2s;
       &:hover{
           transform: scale(1.1);
       }
       a{
           width:100%;
           height:100%;
           text-decoration:none;
           div{
               display:flex;
               height: 100%;
               align-items:center;
               justify-content:center;
               background-color:rgba(223, 230, 229, 0.8);
               p{
                   margin:0;
                   color:black;
                   font-weight:bold;
                   font-size:20px;
               }
           }
       }
   }
   .brand{
       background-image: url("https://allgoodtales.com/wp-content/uploads/2018/10/Nike-Header-min.jpg");
   }
    .sneakers{
        background-image:url("https://www.kickz.com/images/landingpages/jordan/LEGACY312/1400x700-Jordan-Legacy312-Hero-Banner.jpg")
    }
   .btnNews{
       background-image:url("https://www.side-step.co.za/wp-content/uploads/2019/12/Side-Step-Street-News-Banner-New.jpg")
   }

</style>