<template>
    <div id="add-vihara">
        <panel title="Tambah Vihara">
            <template slot="body">
                <vihara-form :formData="formData"
                             :loading="loading"
                             @saveVihara="saveVihara"
                             ref="form"
                ></vihara-form>
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
                    phone_number: "",
                    address: "",
                    region_id: null
                },
                loading: false
            }
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            ViharaForm: () => import('../form/_index')
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
            saveVihara() {
                this.loading = true

                this.formData.district_id = this.userLogin.district_id

                request.post('/api/vihara/create', this.formData, this.accessToken)
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

    #add-vihara
        padding-top 15px
</style>
