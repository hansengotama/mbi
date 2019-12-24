<template>
    <div class="header">
        <div class="logo-container">
            <i class="fa fa-bars"></i>
            <div>MBI <span class="orange">{{ label }}</span></div>
        </div>
        <div class="profile-container" @mouseover="openLogout()" @mouseleave="closeLogout()">
            <img src="../../../../public/images/admin/profile-picture.jpg">
            <div class="text">{{ user.name }}</div>
            <i class="fas fa-caret-down"></i>
            <div class="logout-container" v-if="showLogout">
                <div class="logout-text" @click="logout()">Logout</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                label: "",
                showLogout: false
            }
        },
        mounted() {
            this.setLabel()
        },
        methods: {
            setLabel() {
                if(this.user.role == "admin")
                    this.label = "KABUPATEN ADMIN"

                if(this.user.role == "super_admin")
                    this.label = "SUPER ADMIN"

                if(this.user.role == "pic_kecamatan")
                    this.label = "KECAMATAN ADMIN"
            },
            openLogout() {
                this.showLogout = true
            },
            closeLogout() {
                this.showLogout = false
            },
            logout() {
                this.$emit('isLogin', false)

                this.$router.push({
                    name: "Logout"
                })
            }
        },
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
        z-index 10
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

    .header > .profile-container > .logout-container
        position absolute
        top 49px
        right 14px

    .header > .profile-container > .logout-container > .logout-text
        background white
        padding 10px 50px
        border-bottom-left-radius 5px
        border-bottom-right-radius 5px
        border 1px solid #eaeaea

    .header > .profile-container > .logout-container > .logout-text:hover
        background $orange
        color white

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
