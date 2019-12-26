<template>
    <div class="region-form">
        <div class="form-container">
            <div class="label">
                Nama
            </div>
            <div class="input-container">
                <input type="text" placeholder="nama" v-model="formData.name" :class="error.class.name">
                <small class="red">{{ error.message.name }}</small>
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
                        name: ""
                    },
                    class: {
                        name: ""
                    }
                }
            }
        },
        methods: {
            validate() {
                let validate = true

                if(!this.validateName()) validate = false

                if(validate)
                    this.$emit('saveRegion')
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
            resetForm() {
                this.formData.name = ""
            }

        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    .region-form
        margin 1em
        margin-top -1em

    .region-form > .form-container
        display flex
        align-items center
        margin-top 2em

    .region-form > .form-container > .label
        flex 1

    .region-form > .form-container > .input-container
        flex 2

    .region-form > .form-container > .input-container > input
        width 100%
        box-shadow 2px 2px 1px 0 #eaeaea
        border 1px solid #eaeaea
        border-radius 3px
        padding 6px 12px

    .region-form > .form-container > .input-container > input.error
        border 1px solid red
        box-shadow 2px 2px 1px 0 red

    .region-form > .button-container
        margin-top 2em

    .region-form > .button-container > button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        text-transform uppercase
        cursor pointer

    .region-form > .button-container > .loading
        margin-left -25px
</style>
