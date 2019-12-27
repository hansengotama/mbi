<template>
    <div id="edit-donation">
        <div class="back-to-management" @click="backToManagement()">
            <i class="fa fa-arrow-left"></i> KEMBALI
        </div>
        <panel title="Ubah Donation">
            <template slot="body">
                <donation-form :formData="formData"
                             :loading="loading"
                             @saveDonation="saveDonation"
                             ref="form"
                ></donation-form>
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
                    donors_name: "",
                    amount: ""
                },
                loading: false,
                selectedDonation: null
            }
        },
        mounted() {
            this.setData()
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            DonationForm: () => import('../form/_index')
        },
        methods: {
            setData() {
                let data = this.$route.params.data
                if(!data) {
                    this.backToManagement()
                    return false
                }

                this.selectedDonation = data.id
                this.formData.donors_name = data.donors_name
                this.formData.amount = data.amount
                this.formData.district_id = data.district_id
            },
            saveDonation() {
                this.loading = true

                request.post('/api/donation/update/'+ this.selectedDonation, this.formData, this.accessToken)
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
                    name: "Donation Management"
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #edit-donation
        padding-top 15px

    .back-to-management
        padding-left 15px
        color $orange
        font-weight 700
        cursor pointer
        margin-top 1em
</style>
