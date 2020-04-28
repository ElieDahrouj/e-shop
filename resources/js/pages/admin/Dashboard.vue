<template>
    <div>
        <header id="header" class="container">
            <navigation></navigation>
        </header>
        <div class="container">
            <div class="card card-default">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    Bienvenue sur votre dashboard administrateur
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import navigation from '../../components/Navigation'
    export default {
        name:'dashboard',
        components:{
            navigation
        }
    }
</script>