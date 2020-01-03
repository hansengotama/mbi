<template>
    <div id="edit-district">
        <div class="back-to-management" @click="backToManagement()">
            <i class="fa fa-arrow-left"></i> KEMBALI
        </div>
        <panel title="Ubah Kabupaten">
            <template slot="body">
                <district-form :formData="formData"
                               :loading="loading"
                               :activeSecondAccountNumber="activeSecondAccountNumber"
                               @saveDistrict="saveDistrict"
                               ref="form"
                ></district-form>
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
                    account_number_1: "",
                    account_name_1: "",
                    bank_name_1: "",
                    account_number_2: "",
                    account_name_2: "",
                    bank_name_2: ""
                },
                loading: false,
                activeSecondAccountNumber: {
                    status: false
                },
                selectedDistrict: null
            }
        },
        mounted() {
            this.setData()
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            DistrictForm: () => import('../form/_index')
        },
        methods: {
            setData() {
                let data = this.$route.params.data
                if(!data) {
                    this.backToManagement()
                    return false
                }

                this.selectedDistrict = data.id
                this.formData.name = data.name
                this.formData.account_number_1 = data.account_number_1
                this.formData.account_name_1 = data.account_name_1
                this.formData.bank_name_1 = data.bank_name_1
                this.formData.account_number_2 = data.account_number_2
                this.formData.account_name_2 = data.account_name_2
                this.formData.bank_name_2 = data.bank_name_2

                if(data.account_number_2)
                    this.activeSecondAccountNumber.status = true
            },
            saveDistrict() {
                this.loading = true

                request.post('/api/district/update/'+ this.selectedDistrict, this.formData, this.accessToken)
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
                    name: "District Management"
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #edit-district
        padding-top 15px

    .back-to-management
        padding-left 15px
        color $orange
        font-weight 700
        cursor pointer
        margin-top 1em
</style>
