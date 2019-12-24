<template>
    <div id="add-district">
        <panel title="Tambah Kabupaten">
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
                    account_number_2: "",
                    account_name_2: ""
                },
                loading: false,
                activeSecondAccountNumber: {
                    status: false
                }
            }
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            DistrictForm: () => import('../form/_index')
        },
        methods: {
            saveDistrict() {
                this.loading = true

                request.post('/api/district/create', this.formData, this.accessToken)
                .then((response) => {
                    this.loading = false
                    if(response.data.success) {
                        alert.success()
                        this.$refs.form.resetForm()
                    }else
                        alert.error()
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #add-district
        padding-top 15px
</style>
