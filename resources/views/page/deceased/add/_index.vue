<template>
    <div id="add-deceased">
        <panel title="Tambah Deceased">
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
                    photo_url: ""
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
