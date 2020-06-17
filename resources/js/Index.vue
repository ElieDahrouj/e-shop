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
    .nameOfFile{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .loader {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid orange;
        border-bottom: 5px solid orange;
        width: 20px;
        height: 20px;
        animation: spin 2s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>