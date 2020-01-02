<template>
    <div id="add-deceased">
        <panel title="Tambah orang meninggal">
            <template slot="body">
                <deceased-form :formData="formData"
                               :loading="loading"
                               :isEdit="false"
                               :accessToken="accessToken"
                               @saveDeceased="saveDeceased"
                               ref="form"
                ></deceased-form>
            </template>
        </panel>
    </div>
</template>

<script>
    import request from "../../../../helper/request"
    import alert from "../../../../helper/alert"
    import moment from "moment"

    export default {
        props: ['accessToken'],
        data() {
            return {
                formData: {
                    name: "",
                    close_age: "",
                    buried_date: moment().add(3, 'days').format('YYYY-MM-DD'),
                    deceased_date: moment().format('YYYY-MM-DD'),
                    buried_at: "",
                    type: "",
                    photo_url: "",
                    region_id: null
                },
                loading: false
            }
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            DeceasedForm: () => import('../form/_index')
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
            saveDeceased() {
                this.loading = true
                this.formData.district_id = this.userLogin.district_id

                request.post('/api/deceased/create', this.formData, this.accessToken)
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

    #add-deceased
        padding-top 15px
</style>
