<template>
    <div id="edit-vihara">
        <div class="back-to-management" @click="backToManagement()">
            <i class="fa fa-arrow-left"></i> KEMBALI
        </div>
        <panel title="Ubah Vihara">
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
                    address: ""
                },
                loading: false,
                selectedVihara: null
            }
        },
        mounted() {
            this.setData()
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            ViharaForm: () => import('../form/_index')
        },
        methods: {
            setData() {
                let data = this.$route.params.data
                if(!data) {
                    this.backToManagement()
                    return false
                }

                this.selectedVihara = data.id
                this.formData.name = data.name
                this.formData.phone_number = data.phone_number
                this.formData.address = data.address
                this.formData.region_id = data.region_id
                this.formData.district_id = data.district_id
            },
            saveVihara() {
                this.loading = true

                request.post('/api/vihara/update/'+ this.selectedVihara, this.formData, this.accessToken)
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
                    name: "Vihara Management"
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #edit-vihara
        padding-top 15px

    .back-to-management
        padding-left 15px
        color $orange
        font-weight 700
        cursor pointer
        margin-top 1em
</style>
