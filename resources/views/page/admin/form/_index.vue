<template>
    <div class="district-form">
        <div class="form-container">
            <div class="label">
                Admin Kabupaten
            </div>
            <div class="input-container">
                <select v-model="formData.district_id">
                    <option :value="data.id" v-for="data in district">{{ data.name }}</option>
                </select>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Nama
            </div>
            <div class="input-container">
                <input type="text" placeholder="nama" v-model="formData.name" :class="error.class.name">
                <small class="red">{{ error.message.name }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Email
            </div>
            <div class="input-container">
                <input type="text" placeholder="email" v-model="formData.email" :class="error.class.email">
                <small class="red">{{ error.message.email }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Kata Sandi
            </div>
            <div class="input-container">
                <input type="text" placeholder="kata sandi" v-model="formData.password" :class="error.class.password">
                <small class="red">{{ error.message.password }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Nomor Telepon
            </div>
            <div class="input-container">
                <input type="text" placeholder="nomor telepon" v-model="formData.phone_number" :class="error.class.phone_number">
                <small class="red">{{ error.message.phone_number }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Tanggal Lahir
            </div>
            <div class="input-container">
                <input type="date" placeholder="tanggal lahir" v-model="formData.birth_of_date" :class="error.class.birth_of_date">
                <small class="red">{{ error.message.birth_of_date }}</small>
            </div>
        </div>
        <div class="button-container">
            <button v-if="!loading" @click="validate()">simpan</button>
            <div class="loading" v-else>
                <img src="../../../../../public/images/admin/loading.gif" height="30px">
            </div>
        </div>
    </div>
</template>

<script>
    import validator from "../../../../helper/validator"

    export default {
        props: ['formData', 'loading', 'district'],
        data() {
            return {
                error: {
                    class: {
                        district_id: "",
                        name: "",
                        email: "",
                        password: "",
                        birth_of_date: "",
                        phone_number: ""
                    },
                    message: {
                        district_id: "",
                        name: "",
                        email: "",
                        password: "",
                        birth_of_date: "",
                        phone_number: ""
                    }
                }
            }
        },
        mounted() {

        },
        methods: {
            validate() {
                let validate = true
                if(!this.validateName()) validate = false
                if(!this.validateEmail()) validate = false
                if(!this.validatePassword()) validate = false
                if(!this.validateBirthOfDate()) validate = false
                if(!this.validatePhoneNumber()) validate = false

                if(validate == true) this.$emit('saveAdmin')
            },
            validateName() {
                let validate = true

                if(validator.required(this.formData.name)) {
                    validate = false
                    this.error.class.name = "error"
                    this.error.message.name = "Nama harus terisi"
                }else {
                    this.error.class.name = ""
                    this.error.message.name = ""
                }

                return validate
            },
            validateEmail() {
                let validate = true

                if(validator.required(this.formData.email)) {
                    validate = false
                    this.error.class.email = "error"
                    this.error.message.email = "Email harus terisi"
                }else if(validator.emailFormat(this.formData.email)) {
                    validate = false
                    this.error.class.email = "error"
                    this.error.message.email = "Format email harus sesuai"
                }else {
                    this.error.class.email = ""
                    this.error.message.email = ""
                }

                return validate
            },
            validatePassword() {
                let validate = true

                if(validator.required(this.formData.password)) {
                    validate = false
                    this.error.class.password = "error"
                    this.error.message.password = "Kata sandi harus terisi"
                } else if(this.formData.password.length < 8) {
                    validate = false
                    this.error.class.password = "error"
                    this.error.message.password = "Kata sandi harus terdiri dari 8 karakter atau lebih"
                }else {
                    this.error.class.password = ""
                    this.error.message.password = ""
                }

                return validate
            },
            validateBirthOfDate() {
                let validate = true

                if(validator.required(this.formData.birth_of_date)) {
                    validate = false
                    this.error.class.birth_of_date = "error"
                    this.error.message.birth_of_date = "Tanggal lahir harus terisi"
                }else {
                    this.error.class.birth_of_date = ""
                    this.error.message.birth_of_date = ""
                }

                return validate
            },
            validatePhoneNumber() {
                let validate = true

                if(validator.required(this.formData.phone_number)) {
                    validate = false
                    this.error.class.phone_number = "error"
                    this.error.message.phone_number = "Nomor telepon harus terisi"
                }else {
                    this.error.class.phone_number = ""
                    this.error.message.phone_number = ""
                }

                return validate
            },
            resetForm() {
                this.formData.district_id = this.district[0].id
                this.formData.name = ""
                this.formData.email = ""
                this.formData.password = ""
                this.formData.birth_of_date = ""
                this.formData.phone_number = ""
                this.formData.password_confirmation = ""
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    .district-form
        margin 1em
        margin-top -1em

    .district-form > .form-container
        display flex
        align-items center
        margin-top 2em

    .district-form > .form-container > .label
        flex 1

    .district-form > .form-container.checkbox
        cursor pointer

    .district-form > .form-container > .checkbox
        margin-right 5px
        cursor pointer

    .district-form > .form-container > .input-container
        flex 2

    .district-form > .form-container > .input-container > select,
    .district-form > .form-container > .input-container > input
        width 100%
        box-shadow 2px 2px 1px 0 #eaeaea
        border 1px solid #eaeaea
        border-radius 3px
        padding 6px 12px
        background white

    .district-form > .form-container > .input-container > input.error
        border 1px solid red
        box-shadow 2px 2px 1px 0 red

    .district-form > .button-container
        margin-top 2em

    .district-form > .button-container > button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        text-transform uppercase
        cursor pointer

    .district-form > .button-container > .loading
        margin-left -25px
</style>

