<template>
    <div class="deceased-form">
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
                <i class="fa fa-eye" v-show="isEdit" @click="openImage(formData.photo_full_url)"></i> Foto
            </div>
            <div class="input-container">
                <input type="file" @change="setImage($event)" :class="error.class.photo_url" accept="image/*" ref="fileInput">
                <small class="red">{{ error.message.photo_url }}</small>
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
                Umur Terakhir
            </div>
            <div class="input-container">
                <input type="number" placeholder="umur terakhir" v-model="formData.close_age" :class="error.class.close_age">
                <small class="red">{{ error.message.close_age }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Tanggal Meninggal
            </div>
            <div class="input-container">
                <input type="date" placeholder="tanggal meninggal" v-model="formData.deceased_date" :class="error.class.deceased_date">
                <small class="red">{{ error.message.deceased_date }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Tanggal Pemakaman
            </div>
            <div class="input-container">
                <input type="date" placeholder="tanggal pemakanan" v-model="formData.buried_date" :class="error.class.buried_date">
                <small class="red">{{ error.message.buried_date }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Tempat Pemakaman
            </div>
            <div class="input-container">
                <input type="text" placeholder="tempat pemakaman" v-model="formData.buried_at" :class="error.class.buried_at">
                <small class="red">{{ error.message.buried_at }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Tipe
            </div>
            <div class="input-container">
                <input type="text" placeholder="tipe" v-model="formData.type" :class="error.class.type">
                <small class="red">{{ error.message.type }}</small>
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
    import request from "../../../../helper/request"
    import alert from "../../../../helper/alert";

    export default {
        props: ['formData', 'loading', 'isEdit', 'accessToken'],
        data() {
            return {
                error: {
                    message: {
                        name: "",
                        close_age: "",
                        buried_date: "",
                        deceased_date: "",
                        buried_at: "",
                        type: "",
                        photo_url: ""
                    },
                    class: {
                        name: "",
                        close_age: "",
                        buried_date: "",
                        deceased_date: "",
                        buried_at: "",
                        type: "",
                        photo_url: ""
                    }
                },
                file: null,
                mounted: false
            }
        },
        computed: {
            selectedRegion: {
                get() {
                    return this.$store.getters["getSelectedRegion"]
                },
                set(value) {
                    this.$store.commit("setSelectedRegion", value)
                }
            },
            region: {
                get() {
                    return this.$store.getters["getRegion"]
                },
                set(value) {
                    this.$store.commit("setRegion", value)
                }
            }
        },
        watch: {
            selectedRegion: {
                handler: function handler() {
                    if(!this.mounted && this.selectedRegion.id) {
                        this.mounted = true
                        this.formData.region_id = this.selectedRegion.id
                    }
                },
                deep: true,
                immediate: true
            }
        },
        methods: {
            async validate() {
                let validate = true

                if(!this.validateName()) validate = false
                if(!this.validateCloseAge()) validate = false
                if(!this.validateBuriedDate()) validate = false
                if(!this.validateBuriedAt()) validate = false
                if(!this.validateDeceasedDate()) validate = false
                if(!this.validateType()) validate = false
                if(!this.validatePhotoUrl()) validate = false

                if(validate) {
                    if(this.isEdit && this.file != null)
                        await this.removeImage()

                    if(this.file != null)
                        this.formData.photo_url = await this.uploadImage()

                    this.$emit('saveDeceased')
                }
            },
            uploadImage() {
                let imageFile = new FormData()
                let filePath = "idregion" + this.formData.region_id + "/deceased"
                imageFile.append('file_path', filePath)
                imageFile.append('file', this.file)

                return request.post("/api/assets/upload", imageFile, this.accessToken)
                .then((response) => {
                    let file_path = null
                    if(response.data.success)
                        file_path = response.data.result.file_path
                    else
                        alert.error()

                    return file_path
                })
            },
            removeImage() {
                return request.post("/api/assets/remove", {file_path: this.formData.photo_url}, this.accessToken)
                .then((response) => {
                    if(!response.data.success)
                        alert.error()
                })
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
            validateCloseAge() {
                let validate = true

                if(validator.required(this.formData.close_age)) {
                    validate = false
                    this.error.class.close_age = "error"
                    this.error.message.close_age = "Umur terakhir harus terisi"
                }else {
                    this.error.class.close_age = ""
                    this.error.message.close_age = ""
                }

                return validate
            },
            validateBuriedDate() {
                let validate = true

                if(validator.required(this.formData.buried_date)) {
                    validate = false
                    this.error.class.buried_date = "error"
                    this.error.message.buried_date = " Tanggal pemakaman harus terisi"
                }else {
                    this.error.class.buried_date = ""
                    this.error.message.buried_date = ""
                }

                return validate
            },
            validateBuriedAt() {
                let validate = true

                if(validator.required(this.formData.buried_at)) {
                    validate = false
                    this.error.class.buried_at = "error"
                    this.error.message.buried_at = " Tempat pemakaman harus terisi"
                }else {
                    this.error.class.buried_at = ""
                    this.error.message.buried_at = ""
                }

                return validate
            },
            validateDeceasedDate() {
                let validate = true

                if(validator.required(this.formData.deceased_date)) {
                    validate = false
                    this.error.class.deceased_date = "error"
                    this.error.message.deceased_date = " Tempat pemakaman harus terisi"
                }else {
                    this.error.class.deceased_date = ""
                    this.error.message.deceased_date = ""
                }

                return validate
            },
            validateType() {
                let validate = true

                if(validator.required(this.formData.type)) {
                    validate = false
                    this.error.class.type = "error"
                    this.error.message.type = " Tipe harus terisi"
                }else {
                    this.error.class.type = ""
                    this.error.message.type = ""
                }

                return validate
            },
            validatePhotoUrl() {
                let validate = true
                let dataType = []
                if(this.file != null)
                    dataType = this.file.type.split('/')

                if(!this.isEdit && this.file == null) {
                    validate = false
                    this.error.class.photo_url = "error"
                    this.error.message.photo_url = " Foto harus terisi"
                }else if(this.file != null && dataType[0] != "image") {
                    this.error.class.photo_url = "error"
                    this.error.message.photo_url = "File yang diupload harus berupa image"
                }else {
                    this.error.class.photo_url = ""
                    this.error.message.photo_url = ""
                }

                return validate
            },
            resetForm() {
                this.formData.name = ""
                this.formData.close_age = ""
                this.formData.buried_date = ""
                this.formData.deceased_date = ""
                this.formData.buried_at = ""
                this.formData.type = ""
                this.formData.photo_url = ""
                this.formData.region_id = this.selectedRegion.id
                this.file = null
                this.resetImageInputFile()
            },
            resetImageInputFile() {
                let input = this.$refs.fileInput
                input.type = 'text'
                input.type = 'file'
            },
            setImage(e) {
                this.file = e.target.files[0]
            },
            openImage(url) {
                window.open(url, '_target')
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    .deceased-form
        margin 1em
        margin-top -1em

    .deceased-form > .form-container
        display flex
        align-items center
        margin-top 2em

    .deceased-form > .form-container > .label
        flex 1

    .deceased-form > .form-container > .label > i
        cursor pointer

    .deceased-form > .form-container > .input-container
        flex 2

    .deceased-form > .form-container > .input-container > select,
    .deceased-form > .form-container > .input-container > input
        width 100%
        box-shadow 2px 2px 1px 0 #eaeaea
        border 1px solid #eaeaea
        border-radius 3px
        padding 6px 12px
        background white

    .deceased-form > .form-container > .input-container > input.error
        border 1px solid red
        box-shadow 2px 2px 1px 0 red

    .deceased-form > .button-container
        margin-top 2em

    .deceased-form > .button-container > button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        text-transform uppercase
        cursor pointer

    .deceased-form > .button-container > .loading
        margin-left -25px
</style>
