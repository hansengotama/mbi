<template>
    <div id="app">
        <div v-if="isLogined">
            <layout-header :user="userLogin" @isLogin="isLogin"></layout-header>
            <div class="content-container">
                <layout-sidebar :user="userLogin" :region="region"></layout-sidebar>
                <div class="content">
                    <router-view :accessToken="accessToken"></router-view>
                </div>
            </div>
        </div>
        <div v-else>
            <router-view @isLogin="isLogin"></router-view>
        </div>
    </div>
</template>

<script>
    import VueCookie from 'vue-cookie'
    import request from "../helper/request"
    import menu from "../js/router/menu"

    export default {
        data() {
            return {
                isLogined: false,
            }
        },
        computed: {
            userLogin: {
                get() {
                    return this.$store.getters["getUserLogin"]
                },
                set(value) {
                    this.$store.commit("setUserLogin", value)
                }
            },
            accessToken: {
                get() {
                    return this.$store.getters["getAccessToken"]
                },
                set(value) {
                    this.$store.commit("setAccessToken", value)
                }
            },
            region: {
                get() {
                    return this.$store.getters["getRegion"]
                },
                set(value) {
                    this.$store.commit("setRegion", value)
                }
            },
            selectedRegion: {
                get() {
                    return this.$store.getters["getSelectedRegion"]
                },
                set(value) {
                    this.$store.commit("setSelectedRegion", value)
                }
            }
        },
        components: {
            LayoutHeader : () => import('./layout/header/_index.vue'),
            LayoutSidebar : () => import('./layout/sidebar/_index.vue')
        },
        created() {
            this.checkIsLogin()
        },
        methods: {
            async checkIsLogin() {
                this.accessToken = VueCookie.get('access_token')

                if(this.accessToken) {
                    await request.get('/api/user/check', this.accessToken)
                    .then((response) => {
                        if(response.data.success && (response.data.result.role == 'admin'
                            || response.data.result.role == 'super_admin'
                            || response.data.result.role == 'pic_kecamatan')) {
                            this.userLogin = response.data.result
                            this.isLogin(true)
                        } else
                            this.$router.push({
                                name: 'Logout'
                            })
                    })
                }else
                    this.isLogin(false)
            },
            isLogin(status) {
                this.isLogined = status
                if(this.userLogin.role == "pic_kecamatan")
                    this.getUserRegion()
                else if(this.userLogin.role == "admin")
                    this.getRegion()

                this.$forceUpdate()
            },
            getUserRegion() {
                request.get('/api/region/' + this.userLogin.region_id, this.accessToken)
                .then((response) => {
                    if(response.data.success)
                        this.region = response.data.result.data
                })
            },
            getRegion() {
                request.get('/api/region?filter[district_id]=' + this.userLogin.district_id, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        this.region = response.data.result.data
                        this.selectedRegion = response.data.result.data[0]
                    }
                })
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
