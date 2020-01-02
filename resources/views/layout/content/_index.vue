<template>
    <div id="content">
        <router-view :accessToken="accessToken" @getRegion="getRegion"></router-view>
    </div>
</template>

<script>
    export default {
        props: ['accessToken'],
        methods: {
            getRegion() {
                this.$emit('getRegion')
            }
        }
    }
</script>

