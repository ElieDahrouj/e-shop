<template>
    <div id="main">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: 'Index',
    }
</script>
<style>
    .fadeHeight-enter-active, .fadeHeight-leave-active {
        transition: all 0.5s;
        max-height: 255px;
        overflow:hidden;
    }
    .fadeHeight-enter, .fadeHeight-leave-to {
        max-height: 0;
        overflow:hidden;
    }
</style>