<template>
    <div class="vihara-form">
        <div class="form-container">
            <div class="label">
                Kecamatan
            </div>
            <div class="input-container">
                <select v-model="formData.region_id">
                    <option v-for="data in region" :value="data.id">{{ data.name }}</option>
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
                Nomor Telepon
            </div>
            <div class="input-container">
                <input type="text" placeholder="nomor telepon" v-model="formData.phone_number" :class="error.class.phone_number">
                <small class="red">{{ error.message.phone_number }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Alamat
            </div>
            <div class="input-container">
                <input type="text" placeholder="alamat" v-model="formData.address" :class="error.class.address">
                <small class="red">{{ error.message.address }}</small>
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
        props: ['formData', 'loading', 'selectedRegion'],
        data() {
            return {
                error: {
                    message: {
                        name: "",
                        phone_number: "",
                        address: ""
                    },
                    class: {
                        name: "",
                        phone_number: "",
                        address: ""
                    }
                }
            }
        },
        computed: {
            region: {
                get() {
                    return this.$store.getters["getRegion"]
                },
                set(value) {
                    this.$store.commit("setRegion", value)
                }
            }
        },
        mounted() {
            this.formData.region_id = this.selectedRegion.id
        },
        methods: {
            validate() {
                let validate = true

                if(!this.validateName()) validate = false
                if(!this.validatePhoneNumber()) validate = false
                if(!this.validateAddress()) validate = false

                if(validate)
                    this.$emit('saveVihara')
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
            validateAddress() {
                let validate = true

                if(validator.required(this.formData.address)) {
                    validate = false
                    this.error.class.address = "error"
                    this.error.message.address = "Alamat harus terisi"
                }else {
                    this.error.class.address = ""
                    this.error.message.address = ""
                }

                return validate
            },
            resetForm() {
                this.formData.name = ""
                this.formData.phone_number = "",
                this.formData.address = ""
                this.formData.region_id = this.selectedRegion.id
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    .vihara-form
        margin 1em
        margin-top -1em

    .vihara-form > .form-container
        display flex
        align-items center
        margin-top 2em

    .vihara-form > .form-container > .label
        flex 1

    .vihara-form > .form-container > .input-container
        flex 2

    .vihara-form > .form-container > .input-container > select,
    .vihara-form > .form-container > .input-container > input
        width 100%
        box-shadow 2px 2px 1px 0 #eaeaea
        border 1px solid #eaeaea
        border-radius 3px
        padding 6px 12px
        background white

    .vihara-form > .form-container > .input-container > input.error
        border 1px solid red
        box-shadow 2px 2px 1px 0 red

    .vihara-form > .button-container
        margin-top 2em

    .vihara-form > .button-container > button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        text-transform uppercase
        cursor pointer

    .vihara-form > .button-container > .loading
        margin-left -25px
</style>
