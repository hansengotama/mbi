<template>
    <div id="edit-deceased">
        <div class="back-to-management" @click="backToManagement()">
            <i class="fa fa-arrow-left"></i> KEMBALI
        </div>
        <panel title="Ubah Deceased">
            <template slot="body">
                <deceased-form :formData="formData"
                               :loading="loading"
                               @saveDeceased="saveDeceased"
                               :accessToken="accessToken"
                               ref="form"
                               :isEdit="true"
                ></deceased-form>
            </template>
        </panel>
    </div>
</template>

<script>
    import request from "../../../../helper/request"
    import alert from "../../../../helper/alert"

    export default {
        props: ['accessToken'],
        data() {
            return {
                formData: {
                    name: "",
                    close_age: "",
                    buried_date: "",
                    deceased_date: "",
                    buried_at: "",
                    type: "",
                    photo_url: "",
                    region_id: null,
                    district_id: null
                },
                loading: false,
                selectedDeceased: null
            }
        },
        mounted() {
            this.setData()
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            DeceasedForm: () => import('../form/_index')
        },
        methods: {
            setData() {
                let data = this.$route.params.data
                if(!data) {
                    this.backToManagement()
                    return false
                }

                this.selectedDeceased = data.id
                this.formData.name = data.name
                this.formData.close_age = data.close_age
                this.formData.buried_date = data.buried_date
                this.formData.deceased_date = data.deceased_date
                this.formData.buried_at = data.buried_at
                this.formData.type = data.type
                this.formData.photo_url = data.photo_url
                this.formData.photo_full_url = data.photo_full_url
                this.formData.region_id = data.region_id
                this.formData.district_id = data.district_id
            },
            saveDeceased() {
                this.loading = true

                request.post('/api/deceased/update/'+ this.selectedDeceased, this.formData, this.accessToken)
                .then((response) => {
                    this.loading = false
                    if(response.data.success) {
                        alert.success()
                        this.$refs.form.resetForm()
                        this.backToManagement()
                    }else
                        alert.error()
                })
            },
            backToManagement() {
                this.$router.push({
                    name: "Deceased Management"
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #edit-deceased
        padding-top 15px

    .back-to-management
        padding-left 15px
        color $orange
        font-weight 700
        cursor pointer
        margin-top 1em
</style>
