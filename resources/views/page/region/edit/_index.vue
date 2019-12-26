<template>
    <div id="edit-region">
        <div class="back-to-management" @click="backToManagement()">
            <i class="fa fa-arrow-left"></i> KEMBALI
        </div>
        <panel title="Ubah Kecamatan">
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
                    name: "",
                },
                loading: false,
                selectedRegion: null
            }
        },
        mounted() {
            this.setData()
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            RegionForm: () => import('../form/_index')
        },
        methods: {
            setData() {
                let data = this.$route.params.data
                if(!data) {
                    this.backToManagement()
                    return false
                }

                this.selectedRegion = data.id
                this.formData.name = data.name
                this.formData.district_id = data.district_id
            },
            saveRegion() {
                this.loading = true

                request.post('/api/region/update/'+ this.selectedRegion, this.formData, this.accessToken)
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
                    name: "Region Management"
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #edit-region
        padding-top 15px

    .back-to-management
        padding-left 15px
        color $orange
        font-weight 700
        cursor pointer
        margin-top 1em
</style>
