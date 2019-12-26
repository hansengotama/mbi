<template>
    <div id="add-region">
        <panel title="Tambah Kecamatan">
            <template slot="body">
                <region-form :formData="formData"
                               :loading="loading"
                               @saveRegion="saveRegion"
                               ref="form"
                ></region-form>
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
                    name: ""
                },
                loading: false
            }
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            RegionForm: () => import('../form/_index')
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
            saveRegion() {
                this.loading = true

                this.formData.district_id = this.userLogin.district_id
                request.post('/api/region/create', this.formData, this.accessToken)
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

    #add-region
        padding-top 15px
</style>
