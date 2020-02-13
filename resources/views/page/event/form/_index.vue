<template>
    <div class="event-form">
        <div class="form-container">
            <div class="label">
                Kecamatan
            </div>
            <div class="input-container">
                <select v-model="formData.region_id" :class="error.class.region_id" @change="regionChanged()">
                    <option v-for="data in region" :value="data.id">{{ data.name }}</option>
                </select>
                <small class="red">{{ error.message.region_id }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                Vihara
            </div>
            <div class="input-container">
                <select v-model="formData.vihara_id" :class="error.class.vihara_id">
                    <option v-for="data in vihara" :value="data.id">{{ data.name }}</option>
                </select>
                <small class="red">{{ error.message.vihara_id }}</small>
            </div>
        </div>
        <div class="form-container">
            <div class="label">
                <i class="fa fa-eye" v-show="isEdit" @click="openImage(formData.poster_full_url)"></i> Poster
            </div>
            <div class="input-container">
                <input type="file" @change="setImage($event)" :class="error.class.poster_url" accept="image/*" ref="fileInput">
                <small class="red">{{ error.message.poster_url }}</small>
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
                Deskripsi
            </div>
            <div class="input-container">
                <input type="text" placeholder="deskripsi" v-model="formData.description" :class="error.class.description">
                <small class="red">{{ error.message.description }}</small>
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
        <div class="form-detail-container">
            <div class="label" style="margin-top: 10px">
                Rincian
            </div>
            <div class="detail">
                <div class="detail-container" v-for="(data, index) in formData.detail" :key="index">
                    <div class="from">
                        <div class="date">
                            <input type="date" v-model="formData.detail[index].date_from" :class="error.class.detail[index].date_from">
                            <small class="red">{{ error.message.detail[index].date_from }}</small>
                        </div>
                        <div class="time">
                            <input type="time" v-model="formData.detail[index].time_from" :class="error.class.detail[index].time_from">
                            <small class="red">{{ error.message.detail[index].time_from }}</small>
                        </div>
                    </div>
                    <div class="strip">s/d</div>
                    <div class="until">
                        <div class="date">
                            <input type="date" v-model="formData.detail[index].date_until" :class="error.class.detail[index].date_until">
                            <small class="red">{{ error.message.detail[index].date_until }}</small>
                        </div>
                        <div class="time">
                            <input type="time" v-model="formData.detail[index].time_until" :class="error.class.detail[index].time_until">
                            <small class="red">{{ error.message.detail[index].time_until }}</small>
                        </div>
                    </div>
                    <div class="add" @click="removeDetail(index)">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: flex">
            <div style="flex: 1"></div>
            <div style="flex: 2; margin-top: 1em">
                <div style="padding: 8px 6px; background: #eaeaea; color: black; font-weight: 700; text-align: center; cursor: pointer" @click="addDetail()">tambah</div>
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
    import alert from "../../../../helper/alert"

    export default {
        props: ['formData', 'loading', 'isEdit', 'accessToken'],
        data() {
            return {
                error: {
                    message: {
                        region_id: "",
                        vihara_id: "",
                        name: "",
                        description: "",
                        address: "",
                        poster_url: "",
                        detail: [
                            {
                                date_from: "",
                                date_until: "",
                                time_from: "",
                                time_until: "",
                            }
                        ]
                    },
                    class: {
                        region_id: "",
                        vihara_id: "",
                        name: "",
                        description: "",
                        address: "",
                        poster_url: "",
                        detail: [
                            {
                                date_from: "",
                                date_until: "",
                                time_from: "",
                                time_until: "",
                            }
                        ]
                    }
                },
                file: null,
                mounted: false,
                vihara: []
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
                handler() {
                    if(!this.mounted && this.selectedRegion.name) {
                        if(this.region[0].id == null) {
                            this.vihara = [{id: null, name: 'Vihara tidak ditemukan'}]
                            this.formData.vihara_id = null
                        }

                        this.mounted = true
                        this.formData.region_id = this.selectedRegion.id
                        this.getVihara()
                    }
                },
                deep: true,
                immediate: true
            }
        },
        methods: {
            regionChanged() {
                this.getVihara()
            },
            getVihara() {
                request.get('/api/vihara?filter[region_id]=' + this.formData.region_id, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        if(response.data.result.data[0]) {
                            this.vihara = response.data.result.data
                            this.formData.vihara_id = response.data.result.data[0].id
                        } else {
                            this.vihara = [{id: null, name: 'Vihara tidak ditemukan'}]
                            this.formData.vihara_id = null
                        }
                    }
                })
            },
            async validate() {
                let validate = true

                if(!this.validateName()) validate = false
                if(!this.validateDescription()) validate = false
                if(!this.validateAddress()) validate = false
                if(!this.validatePosterUrl()) validate = false
                if(!this.validateViharaId()) validate = false
                if(!this.validateRegionId()) validate = false
                if(!this.validateDetail()) validate = false

                if(validate) {
                    if(this.isEdit && this.file != null)
                        await this.removeImage()

                    if(this.file != null)
                        this.formData.poster_url = await this.uploadImage()

                    this.$emit('saveEvent')
                }
            },
            uploadImage() {
                let imageFile = new FormData()
                let filePath = "idregion" + this.formData.region_id + "/event"
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
                return request.post("/api/assets/remove", {file_path: this.formData.poster_url}, this.accessToken)
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
            validateDescription() {
                let validate = true

                if(validator.required(this.formData.description)) {
                    validate = false
                    this.error.class.description = "error"
                    this.error.message.description = "Deskripsi harus terisi"
                }else {
                    this.error.class.description = ""
                    this.error.message.description = ""
                }

                return validate
            },
            validateAddress() {
                let validate = true

                if(validator.required(this.formData.address)) {
                    validate = false
                    this.error.class.address = "error"
                    this.error.message.address = " Alamat harus terisi"
                }else {
                    this.error.class.address = ""
                    this.error.message.address = ""
                }

                return validate
            },
            validatePosterUrl() {
                let validate = true
                let dataType = []
                if(this.file != null)
                    dataType = this.file.type.split('/')

                if(!this.isEdit && this.file == null) {
                    validate = false
                    this.error.class.poster_url = "error"
                    this.error.message.poster_url = " Poster harus terisi"
                }else if(this.file != null && dataType[0] != "image") {
                    validate = false
                    this.error.class.poster_url = "error"
                    this.error.message.poster_url = "File yang diupload harus berupa image"
                }else {
                    this.error.class.poster_url = ""
                    this.error.message.poster_url = ""
                }

                return validate
            },
            validateViharaId() {
                let validate = true

                if(this.formData.vihara_id == null) {
                    validate = false
                    this.error.class.vihara_id = "error"
                    this.error.message.vihara_id = " Vihara harus di dipilih"
                }else {
                    this.error.class.vihara_id = ""
                    this.error.message.vihara_id = ""
                }

                return validate
            },
            validateRegionId() {
                let validate = true

                if(this.formData.region_id == null) {
                    validate = false
                    this.error.class.region_id = "error"
                    this.error.message.region_id = " Kecamatan harus di dipilih"
                }else {
                    this.error.class.region_id = ""
                    this.error.message.region_id = ""
                }

                return validate
            },
            validateDetail() {
                let validate = true

                for(let i = 0; i < this.formData.detail.length; i++) {
                    if(validator.required(this.formData.detail[i].date_until)) {
                        validate = false
                        this.error.class.detail[i].date_until = "error"
                        this.error.message.detail[i].date_until = "Harus diisi"
                    }else {
                        this.error.class.detail[i].date_until = ""
                        this.error.message.detail[i].date_until = ""
                    }

                    if(validator.required(this.formData.detail[i].date_from)) {
                        validate = false
                        this.error.class.detail[i].date_from = "error"
                        this.error.message.detail[i].date_from = "Harus diisi"
                    }else {
                        this.error.class.detail[i].date_from = ""
                        this.error.message.detail[i].date_from = ""
                    }
                }

                return validate
            },
            resetForm() {
                this.formData.name = ""
                this.formData.description = ""
                this.formData.poster_url = ""
                this.formData.address = ""
                this.formData.region_id = this.selectedRegion.id
                this.file = null
                for(let i = 0; i < this.formData.detail.length; i++) {
                    this.formData.detail[i].date_from = ""
                    this.formData.detail[i].date_until = ""
                    this.formData.detail[i].time_from = ""
                    this.formData.detail[i].time_until = ""
                }
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
            },
            addDetail() {
                this.formData.detail.push({
                    date_from: "",
                    date_until: "",
                    time_from: "",
                    time_until: ""
                })

                this.error.message.detail.push({
                    date_from: "",
                    date_until: "",
                    time_from: "",
                    time_until: ""
                })

                this.error.class.detail.push({
                    date_from: "",
                    date_until: "",
                    time_from: "",
                    time_until: ""
                })
            },
            removeDetail(index) {
                if(this.formData.detail.length <= 1) alert.error()
                else {
                    this.formData.detail.splice(index, 1)
                    this.error.class.detail.splice(index, 1)
                    this.error.message.detail.splice(index, 1)
                }
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    .event-form
        margin 1em
        margin-top -1em

    .event-form > .form-container
        display flex
        align-items center
        margin-top 2em

    .event-form > .form-detail-container
        display flex
        margin-top 2em

    .event-form > .form-container > .label,
    .event-form > .form-detail-container > .label
        flex 1

    .event-form > .form-container > .label > i
        cursor pointer

    .event-form > .form-container > .input-container
        flex 2

    .event-form > .form-detail-container > .detail
        flex 2

    .event-form > .form-detail-container > .detail > .detail-container
        display flex
        align-items center
        margin-top 2em

    .event-form > .form-detail-container > .detail > .detail-container:first-child
        margin-top 0

    .event-form > .form-detail-container > .detail > .detail-container > .from,
    .event-form > .form-detail-container > .detail > .detail-container > .until
        flex 5
        display flex

    .event-form > .form-detail-container > .detail > .detail-container > .from > .date,
    .event-form > .form-detail-container > .detail > .detail-container > .from > .time,
    .event-form > .form-detail-container > .detail > .detail-container > .until > .date,
    .event-form > .form-detail-container > .detail > .detail-container > .until > .time
        flex 1
        margin-right 2px

    .event-form > .form-detail-container > .detail > .detail-container > .from > .date > input,
    .event-form > .form-detail-container > .detail > .detail-container > .from > .time > input,
    .event-form > .form-detail-container > .detail > .detail-container > .until > .date > input,
    .event-form > .form-detail-container > .detail > .detail-container > .until > .time > input
        width 100%
        box-shadow 2px 2px 1px 0 #eaeaea
        border 1px solid #eaeaea
        border-radius 3px
        padding 6px 12px
        background white

    .event-form > .form-detail-container > .detail > .detail-container > .strip,
    .event-form > .form-detail-container > .detail > .detail-container > .add
        flex 1
        text-align center

    .event-form > .form-detail-container > .detail > .detail-container > .add
        cursor pointer

    .event-form > .form-container > .input-container > select,
    .event-form > .form-container > .input-container > input
        width 100%
        box-shadow 2px 2px 1px 0 #eaeaea
        border 1px solid #eaeaea
        border-radius 3px
        padding 6px 12px
        background white

    .event-form > .form-detail-container > .detail > .detail-container > .from > .date > input.error,
    .event-form > .form-detail-container > .detail > .detail-container > .from > .time > input.error,
    .event-form > .form-detail-container > .detail > .detail-container > .until > .date > input.error,
    .event-form > .form-detail-container > .detail > .detail-container > .until > .time > input.error,
    .event-form > .form-container > .input-container > select.error,
    .event-form > .form-container > .input-container > input.error
        border 1px solid red
        box-shadow 2px 2px 1px 0 red

    .event-form > .button-container
        margin-top 2em

    .event-form > .button-container > button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        text-transform uppercase
        cursor pointer

    .event-form > .button-container > .loading
        margin-left -25px
</style>
