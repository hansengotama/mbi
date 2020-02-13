<template>
    <div id="edit-event">
        <div class="back-to-management" @click="backToManagement()">
            <i class="fa fa-arrow-left"></i> KEMBALI
        </div>
        <panel title="Ubah Acara">
            <template slot="body">
                <event-form :formData="formData"
                             :loading="loading"
                             :accessToken="accessToken"
                             :isEdit="true"
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
                    poster_full_url: "",
                    detail: [
                        {
                            date_from: "",
                            date_until: "",
                            time_from: "",
                            time_until: "",
                        }
                    ]
                },
                loading: false,
                selectedEvent: null
            }
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
        mounted() {
            this.setData()
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            EventForm: () => import('../form/_index')
        },
        methods: {
            setData() {
                let data = this.$route.params.data
                if(!data) {
                    this.backToManagement()
                    return false
                }

                this.selectedEvent = data.id
                this.formData.region_id = data.region_id
                this.formData.vihara_id = data.vihara_id
                this.formData.name = data.name
                this.formData.description = data.description
                this.formData.address = data.address
                this.formData.poster_url = data.poster_url
                this.formData.poster_full_url = data.poster_full_url
                let first = true
                for(let i = 0; i < data.event_detail.length; i++) {
                    if(!first) this.$refs.form.addDetail()
                    first = false
                    this.formData.detail[i].date_from = data.event_detail[i].date_from
                    this.formData.detail[i].date_until = data.event_detail[i].date_until
                    this.formData.detail[i].time_from = data.event_detail[i].time_from
                    this.formData.detail[i].time_until = data.event_detail[i].time_until
                }

            },
            saveEvent() {
                this.loading = true
                this.formData.district_id = this.userLogin.district_id

                request.post('/api/event/update/'+ this.selectedEvent, this.formData, this.accessToken)
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
                    name: "Event Management"
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #edit-event
        padding-top 15px

    .back-to-management
        padding-left 15px
        color $orange
        font-weight 700
        cursor pointer
        margin-top 1em
</style>
