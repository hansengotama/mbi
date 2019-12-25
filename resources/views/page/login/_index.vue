<template>
    <div id="login">
        <div class="form-container">
            <div class="logo-container">
                <img src="../../../../public/images/admin/logo.jpeg">
                <div>Majelis Buddhayana Indonesia</div>
            </div>
            <div class="title-border"></div>
            <div class="title">Login</div>
            <div class="input-container">
                <div>Email</div>
                <input type="text"
                       :class="error.class.email"
                       placeholder="Email Address"
                       v-model="form.email"
                       @keyup.enter="validateForm()"
                />
                <div class="red error-message">{{ error.message.email }}</div>
            </div>
            <div class="input-container">
                <div>Password</div>
                <input type="password"
                       :class="error.class.password"
                       placeholder="Password"
                       v-model="form.password"
                       @keyup.enter="validateForm()"
                />
                <div class="red error-message">{{ error.message.password }}</div>
            </div>
            <div class="button-container">
                <button @click="validateForm()">Masuk</button>

                <div class="red error-message" v-if="!loading">{{ error.message.global }}</div>
                <div class="loading" v-else>
                    <img src="../../../../public/images/admin/loading.gif" height="30px">
                </div>
            </div>
        </div>
        <div class="login-background">
            <div class="background-container">
                <div class="border"></div>
                <div class="text">Majelis Buddhayana Indonesia</div>
            </div>
        </div>
    </div>
</template>

<script>
    import validator from "../../../helper/validator"
    import request from "../../../helper/request"
    import VueCookie from 'vue-cookie'

    export default {
        data() {
            return {
                form: {
                    email: "",
                    password: ""
                },
                error: {
                    message: {
                        email: "",
                        password: "",
                        global: ""
                    },
                    class: {
                        email: "",
                        password: ""
                    }
                },
                loading: false
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
            }
        },
        methods: {
            validateForm() {
                let validateEmail = this.validateEmail()
                let validatePassword = this.validatePassword()

                if (validateEmail && validatePassword)
                    this.checkUser()
            },
            checkUser() {
                this.loading = true

                request.post("/api/login", {
                    email: this.form.email,
                    password: this.form.password
                })
                .then((response) => {
                    this.loading = false

                    if(response.data.code == 200) {
                        if(response.data.result.role == "admin" || response.data.result.role == "super_admin"  || response.data.result.role == "pic_kecamatan" ){
                            this.error.message.global = ""

                            this.accessToken = response.data.result.access_token
                            VueCookie.set('access_token', response.data.result.access_token)
                            this.$emit('isLogin', true)
                            this.userLogin = response.data.result

                            this.$router.push({
                                name: 'Home'
                            })
                        }else
                            this.error.message.global = "Mohon maaf, anda bukan admin"
                    } else
                        this.error.message.global = response.data.message
                })
            },
            validateEmail() {
                let response = false

                if (validator.required(this.form.email)) {
                    this.error.message.email = "Email harus diisi"
                    this.error.class.email = "error"
                } else if (validator.emailFormat(this.form.email)) {
                    this.error.message.email = "Format email harus sesuai"
                    this.error.class.email = "error"
                } else {
                    this.error.message.email = ""
                    this.error.class.email = ""

                    response = true
                }

                return response
            },
            validatePassword() {
                let response = false

                if (validator.required(this.form.password)) {
                    this.error.message.password = "Password harus diisi"
                    this.error.class.password = "error"
                } else {
                    this.error.message.password = ""
                    this.error.class.password = ""

                    response = true
                }

                return response
            },
        }
    }
</script>

<style lang="stylus" scoped>
    @import "../../../stylus/app.styl"

    #login
        display flex

    .login-background
        flex 5
        order 1
        background-image url("/images/admin/login-background.jpg")
        background-repeat no-repeat
        background-size cover
        height 100vh
        width 100%
        position relative

    .login-background > .background-container
        position absolute
        bottom 10px
        left 20px

    .login-background > .background-container > .border
        border 4px solid $orange !important
        width 30%

    .login-background > .background-container > .text
        font-size 46px
        color white

    .form-container
        flex 2
        order 2
        display flex
        flex-direction column
        padding 2em
        background white

    .form-container > .title-border
        border-bottom 2px solid #eaeaea
        width 60%
        margin 1em auto 2em

    .form-container > .logo-container
        display flex
        align-items center
        margin 0 auto
        flex-direction column

    .form-container > .logo-container > img
        width 50px
        margin-bottom 5px

    .form-container > .title
        font-size 24px
        font-weight 800

    .form-container > .title-description
        font-size 14px

    .form-container > .input-container
        margin-top 2em
        font-size 14px

    .form-container > .input-container > input
        padding 8px 6px
        width 100%
        border none
        border-bottom 2px solid #EAEAEA

    .form-container > .input-container > input:active,
    .form-container > .input-container > input:focus
        border-color $orange !important

    .form-container > .button-container
        margin-top 1em

    .form-container > .button-container > button
        padding 6px 3em
        background $orange
        color white
        border none
        cursor pointer
        border-radius 15px

    .form-container > .button-container > .loading
        margin-left -25px

    .error-message
        font-size 14px
        margin-top 5px

    @media (max-width: 1200px)
        .login-background > .background-container > .text
            font-size 30px

    @media (max-width: 900px)
        .login-background
            display none
</style>
