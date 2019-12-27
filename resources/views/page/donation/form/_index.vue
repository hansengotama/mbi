<template>
    <div class="donation-form">
        <div class="form-container">
            <div class="label">
                Nama Donatur
            </div>
            <div class="input-container">
                <input type="text" placeholder="nama donatur" v-model="formData.donors_name" :class="error.class.donors_name">
                <small class="red">{{ error.message.donors_name }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Jumlah
            </div>
            <div class="input-container">
                <input type="text" placeholder="jumlah" v-model="formData.amount" :class="error.class.amount">
                <small class="red">{{ error.message.amount }}</small>
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
        props: ['formData', 'loading'],
        data() {
            return {
                error: {
                    message: {
                        donors_name: "",
                        amount: ""
                    },
                    class: {
                        donors_name: "",
                        amount: ""
                    }
                }
            }
        },
        methods: {
            validate() {
                let validate = true

                if(!this.validateDonorsName()) validate = false
                if(!this.validateAmount()) validate = false

                if(validate)
                    this.$emit('saveDonation')
            },
            validateDonorsName() {
                let validate = true

                if(validator.required(this.formData.donors_name)) {
                    validate = false
                    this.error.class.donors_name = "error"
                    this.error.message.donors_name = "Nama Donatur harus terisi"
                }else {
                    this.error.class.donors_name = ""
                    this.error.message.donors_name = ""
                }

                return validate
            },
            validateAmount() {
                let validate = true

                if(validator.required(this.formData.amount)) {
                    validate = false
                    this.error.class.amount = "error"
                    this.error.message.amount = "Jumlah harus terisi"
                }else {
                    this.error.class.amount = ""
                    this.error.message.amount = ""
                }

                return validate
            },
            resetForm() {
                this.formData.donors_name = ""
                this.formData.amount = ""
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    .donation-form
        margin 1em
        margin-top -1em

    .donation-form > .form-container
        display flex
        align-items center
        margin-top 2em

    .donation-form > .form-container > .label
        flex 1

    .donation-form > .form-container > .input-container
        flex 2

    .donation-form > .form-container > .input-container > select,
    .donation-form > .form-container > .input-container > input
        width 100%
        box-shadow 2px 2px 1px 0 #eaeaea
        border 1px solid #eaeaea
        border-radius 3px
        padding 6px 12px
        background white

    .donation-form > .form-container > .input-container > input.error
        border 1px solid red
        box-shadow 2px 2px 1px 0 red

    .donation-form > .button-container
        margin-top 2em

    .donation-form > .button-container > button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        text-transform uppercase
        cursor pointer

    .donation-form > .button-container > .loading
        margin-left -25px
</style>
