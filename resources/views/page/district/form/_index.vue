<template>
    <div class="district-form">
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
                Nomor Rekening
            </div>
            <div class="input-container">
                <input type="text" placeholder="nomor rekening" v-model="formData.account_number_1" :class="error.class.account_number_1">
                <small class="red">{{ error.message.account_number_1 }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Nama Rekening
            </div>
            <div class="input-container">
                <input type="text" placeholder="nama rekening" v-model="formData.account_name_1" :class="error.class.account_name_1">
                <small class="red">{{ error.message.account_name_1 }}</small>
            </div>
        </div>
        <div class="form-container checkbox" @click="toggleActiveSecondAccountNumber">
            <input type="checkbox" class="checkbox" v-model="activeSecondAccountNumber.status"> Aktifkan akun rekening kedua
        </div>
        <div class="form-container" v-show="activeSecondAccountNumber.status">
            <div class="label">
                Nomor Rekening (2)
            </div>
            <div class="input-container">
                <input type="text" placeholder="nomor rekening (2)" v-model="formData.account_number_2" :class="error.class.account_number_2">
                <small class="red">{{ error.message.account_number_2 }}</small>
            </div>
        </div>
        <div class="form-container" v-show="activeSecondAccountNumber.status">
            <div class="label">
                Nama Rekening (2)
            </div>
            <div class="input-container">
                <input type="text" placeholder="nama rekening (2)" v-model="formData.account_name_2" :class="error.class.account_name_2">
                <small class="red">{{ error.message.account_name_2 }}</small>
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
        props: ['formData', 'loading', 'activeSecondAccountNumber'],
        data() {
            return {
                error: {
                    class: {
                        name: "",
                        account_number_1: "",
                        account_name_1: "",
                        account_number_2: "",
                        account_name_2: ""
                    },
                    message: {
                        name: "",
                        account_number_1: "",
                        account_name_1: "",
                        account_number_2: "",
                        account_name_2: ""
                    }
                }
            }
        },
        methods: {
            validate() {
                let validate = true
                if(!this.validateName()) validate = false
                if(!this.validateAccountNumber()) validate = false
                if(!this.validateAccountName()) validate = false
                if(!this.validateSecondAccountNumber()) validate = false
                if(!this.validateSecondAccountName()) validate = false

                if(validate) {
                    if(!this.activeSecondAccountNumber.status) {
                        this.formData.account_number_2 = ""
                        this.formData.account_name_2 = ""
                    }

                    this.$emit('saveDistrict')
                }
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
            validateAccountNumber() {
                let validate = true

                if(validator.required(this.formData.account_number_1)) {
                    validate = false
                    this.error.class.account_number_1 = "error"
                    this.error.message.account_number_1 = "Nomor rekening harus terisi"
                }else {
                    this.error.class.account_number_1 = ""
                    this.error.message.account_number_1 = ""
                }

                return validate
            },
            validateAccountName() {
                let validate = true

                if(validator.required(this.formData.account_name_1)) {
                    validate = false
                    this.error.class.account_name_1 = "error"
                    this.error.message.account_name_1 = "Nama rekening harus terisi"
                }else {
                    this.error.class.account_name_1 = ""
                    this.error.message.account_name_1 = ""
                }

                return validate
            },
            validateSecondAccountNumber() {
                let validate = true

                if(this.activeSecondAccountNumber.status && validator.required(this.formData.account_number_2)) {
                    validate = false
                    this.error.class.account_number_2 = "error"
                    this.error.message.account_number_2 = "Nomor rekening (2) harus terisi"
                }else {
                    this.error.class.account_number_2 = ""
                    this.error.message.account_number_2 = ""
                }

                return validate
            },
            validateSecondAccountName() {
                let validate = true

                if(this.activeSecondAccountNumber.status && validator.required(this.formData.account_name_2)) {
                    validate = false
                    this.error.class.account_name_2 = "error"
                    this.error.message.account_name_2 = "Nama rekening (2) harus terisi"
                }else {
                    this.error.class.account_name_2 = ""
                    this.error.message.account_name_2 = ""
                }

                return validate
            },
            toggleActiveSecondAccountNumber() {
                this.activeSecondAccountNumber.status = !this.activeSecondAccountNumber.status

                if(!this.activeSecondAccountNumber.status) this.resetSecondError()
            },
            resetSecondError() {
                this.validateSecondAccountNumber()
                this.validateSecondAccountName()
            },
            resetForm() {
                this.formData.name = ""
                this.formData.account_number_1 = ""
                this.formData.account_name_1 = ""
                this.formData.account_number_2 = ""
                this.formData.account_name_2 = ""
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

    .district-form > .form-container > .input-container > input
        width 100%
        box-shadow 2px 2px 1px 0 #eaeaea
        border 1px solid #eaeaea
        border-radius 3px
        padding 6px 12px

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

