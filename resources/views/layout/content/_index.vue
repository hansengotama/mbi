<template>
    <div id="content">
        <router-view :accessToken="accessToken"></router-view>
    </div>
</template>

<script>
    export default {
        props: ['accessToken']
    }
</script>

