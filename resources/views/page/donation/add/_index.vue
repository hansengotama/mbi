<template>
    <div id="add-donation">
        <panel title="Tambah Donation">
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
                loading: false
            }
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            DonationForm: () => import('../form/_index')
        },
        computed: {
            userLogin: {
                get() {
                    return this.$store.getters["getUserLogin"]
                },
                set(value) {
                    this.$store.commit("setUserLogin", value)
                }
            }
        },
        methods: {
            saveDonation() {
                this.loading = true

                this.formData.district_id = this.userLogin.district_id

                request.post('/api/donation/create', this.formData, this.accessToken)
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

    #add-donation
        padding-top 15px
</style>
