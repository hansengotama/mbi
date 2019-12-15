<template>
    <div class="header">
        <div class="logo-container">
            <i class="fa fa-bars"></i>
            <div>MBI <span class="orange">ADMIN</span></div>
        </div>
        <div class="profile-container">
            <img src="../../../../public/images/admin/profile-picture.jpg">
            <div class="text">{{ user.name }}</div>
            <i class="fas fa-caret-down"></i>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        mounted() {

        }
    }
</script>

<style lang="stylus" scoped>
    @import "../../../stylus/app.styl"

    .header
        width 100%
        display flex
        padding 0.4em 1em
        border-bottom 1px solid #eaeaea
        position fixed
        justify-content space-between
        z-index 9999
        background white

    .header > .logo-container
        display flex
        align-items center

    .header > .logo-container > div
        font-size 18px
        margin 0 8px

    .header > .logo-container > .fa
        font-size 15px
        cursor pointer

    .header > .profile-container
        border 1px solid #eaeaea
        border-radius 5px
        display flex
        align-items center
        padding 5px
        cursor pointer

    .header > .profile-container > img
        width 33px
        height 33px
        object-fit contain

    .header > .profile-container > .text
        font-size 14px
        margin 0 5px

    .header > .profile-container > .fas
        color #A4AABA

    .header > .profile-container:hover > .fas
        color black
</style>
