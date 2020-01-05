<template>
    <div id="change-password">
        <panel title="Ganti Password">
            <template slot="body">
                <div class="change-password-form" v-if="isValidatePasswordStep">
                    <div class="form-container">
                        <div class="label">
                            Kata sandi Sekarang
                        </div>
                        <div class="input-container">
                            <input type="password" placeholder="kata sandi sekarang" v-model="formData.password_before" :class="error.class.password_before">
                            <small class="red">{{ error.message.password_before }}</small>
                        </div>
                    </div>
                    <div class="button-container">
                        <button v-if="!loading" @click="validatePasswordBefore()">lanjutkan</button>
                        <div class="loading" v-else>
                            <img src="../../../../../public/images/admin/loading.gif" height="30px">
                        </div>
                    </div>
                </div>
                <div class="change-password-form" v-else>
                    <div class="form-container">
                        <div class="label">
                            Kata sandi baru
                        </div>
                        <div class="input-container">
                            <input type="password" placeholder="kata sandi baru" v-model="formData.new_password" :class="error.class.new_password">
                            <small class="red">{{ error.message.new_password }}</small>
                        </div>
                    </div>
                    <div class="button-container">
                        <button v-if="!loading" @click="validateNewPassword()">simpan</button>
                        <div class="loading" v-else>
                            <img src="../../../../../public/images/admin/loading.gif" height="30px">
                        </div>
                    </div>
                </div>
            </template>
        </panel>
    </div>
</template>

<script>
    import validator from "../../../../helper/validator";
    import request from "../../../../helper/request";
    import alert from "../../../../helper/alert";

    export default {
        props: ['accessToken'],
        components: {
            Panel: () => import('../../../../components/panel/_index'),
        },
        data() {
            return {
                error: {
                    message: {
                        password_before: "",
                        new_password: ""
                    },
                    class: {
                        password_before: "",
                        new_password: ""
                    },
                },
                formData: {
                    password_before: "",
                    new_password: ""
                },
                loading: false,
                isValidatePasswordStep: true
            }
        },
        computed: {
            userLogin: {
                get() {
                    return this.$store.getters["getUserLogin"];
                },
                set(value) {
                    this.$store.commit("setUserLogin", value);
                }
            }
        },
        methods: {
            validatePasswordBefore() {
                if(validator.required(this.formData.password_before)) {
                    this.error.class.password_before = "error"
                    this.error.message.password_before = "Kata sandi sekarang harus terisi"
                }else {
                    this.error.class.password_before = ""
                    this.error.message.password_before = ""
                    this.checkPasswordBefore()
                }
            },
            validateNewPassword() {
                if(validator.required(this.formData.new_password)) {
                    this.error.class.new_password = "error"
                    this.error.message.new_password = "Kata sandi baru harus terisi"
                }else if(this.formData.new_password.length < 8) {
                    this.error.class.new_password = "error"
                    this.error.message.new_password = "Kata sandi harus terdiri dari 8 karakter atau lebih"
                }else {
                    this.error.class.new_new_password = ""
                    this.error.message.new_new_password = ""
                    this.submitNewPassword()
                }
            },
            checkPasswordBefore() {
                this.loading = true
                request.post("/api/user/check/password", {password: this.formData.password_before} , this.accessToken)
                .then((response) => {
                    this.loading = false
                    if(response.data.success) {
                        this.isValidatePasswordStep = false
                    }else {
                        this.error.class.password_before = "error"
                        this.error.message.password_before = "Password anda salah"
                    }
                })
            },
            submitNewPassword() {
                this.loading = true
                let data = {}
                data.name = this.userLogin.name
                data.email = this.userLogin.email
                data.role = this.userLogin.role
                data.birth_of_date = this.userLogin.birth_of_date
                data.phone_number = this.userLogin.birth_of_date
                data.password = this.formData.new_password

                request.post("/api/user/update/" + this.userLogin.id, data, this.accessToken)
                .then((response) => {
                    this.loading = false
                    if(response.data.success) {
                        this.resetPassword()
                        this.isValidatePasswordStep = true
                        alert.success()
                    }else {
                        alert.error(response.data.message)
                    }
                })
            },
            resetPassword() {
                this.formData.password_before = ""
                this.formData.new_password = ""
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    .change-password-form
        margin 1em
        margin-top -1em

    .change-password-form > .form-container
        display flex
        align-items center
        margin-top 2em

    .change-password-form > .form-container > .label
        flex 1

    .change-password-form > .form-container > .input-container
        flex 2

    .change-password-form > .form-container > .input-container > input
        width 100%
        box-shadow 2px 2px 1px 0 #eaeaea
        border 1px solid #eaeaea
        border-radius 3px
        padding 6px 12px

    .change-password-form > .form-container > .input-container > input.error
        border 1px solid red
        box-shadow 2px 2px 1px 0 red

    .change-password-form > .button-container
        margin-top 2em

    .change-password-form > .button-container > button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        text-transform uppercase
        cursor pointer

    .change-password-form > .button-container > .loading
        margin-left -25px

</style>
