<template>
    <div id="add-event">
        <panel title="Tambah Kegiatan">
            <template slot="body">
                <event-form :formData="formData"
                               :loading="loading"
                               :isEdit="false"
                               :accessToken="accessToken"
                               @saveEvent="saveEvent"
                               ref="form"
                ></event-form>
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
                    region_id: null,
                    vihara_id: null,
                    name: "",
                    description: "",
                    address: "",
                    poster_url: "",
                    detail: [
                        {
                            from: "",
                            to: "",
                            isAdd: true
                        }
                    ]
                },
                loading: false
            }
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            EventForm: () => import('../form/_index')
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
            saveEvent() {
                this.loading = true
                this.formData.district_id = this.userLogin.district_id

                request.post('/api/event/create', this.formData, this.accessToken)
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

    #add-event
        padding-top 15px
</style>
