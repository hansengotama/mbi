<template>
    <div id="app">
        <div v-if="isLogin">
            <layout-header :user="user"></layout-header>
            <div class="content-container">
                <layout-sidebar></layout-sidebar>
                <div class="content">
                    <router-view :accessToken="accessToken"></router-view>
                </div>
            </div>
        </div>
        <div v-else>
            <router-view @checkIsLogin="checkIsLogin"></router-view>
        </div>
    </div>
</template>

<script>
    import VueCookie from 'vue-cookie'
    import request from "../helper/request"

    export default {
        data() {
            return {
                isLogin: true,
                accessToken: "",
                user: {}
            }
        },
        components: {
            LayoutHeader : () => import('./layout/header/_index.vue'),
            LayoutSidebar : () => import('./layout/sidebar/_index.vue')
        },
        mounted() {
            this.checkIsLogin()
        },
        methods: {
            async checkIsLogin() {
                this.accessToken = VueCookie.get('access_token')

                if(this.accessToken) {
                    await request.get('/api/user/check', this.accessToken)
                    .then((response) => {
                        if(response.data.success && response.data.result.role == 'admin') {
                            this.user = response.data.result
                            this.isLogin = true

                            this.$forceUpdate()
                        } else
                            this.$router.push({
                                name: 'Login'
                            })
                    })
                }else
                    this.isLogin = false
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../stylus/app.styl"

    #app
        width 100%
        background #f0f0f0

    .content-container
        display block
        padding-top 4.1em

    .content
        padding-left 18em
        min-height 100vh
</style>
