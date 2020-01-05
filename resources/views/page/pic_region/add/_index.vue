<template>
    <div id="add-pic-region">
        <panel title="Tambah PIC Kecamatan (Jika belum memiliki akun)">
            <template slot="body">
                <pic-region-form :formData="formData"
                                 :loading="loading"
                                 :selectedRegion="selectedRegion"
                                 :regionData="region"
                                 @savePicRegion="savePicRegion"
                                 ref="form"
                ></pic-region-form>
            </template>
        </panel>
        <panel title="Tambah PIC Kecamatan">
            <template slot="body">
                <div class="filter-container">
                    <search @search="search" class="mt-3"></search>
                </div>
                <div class="table-container mt-3">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tr v-if="user.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in user.data" v-else>
                            <td>{{ index+1 }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.email }}</td>
                            <td>{{ data.phone_number }}</td>
                            <td width="100px" class="text-center">
                                <i class="fa fa-tasks" @click="chooseRegionModal(data)"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="user" @changePaginate="changePaginate"></paginate>
            </template>
        </panel>

        <!-- Modal -->
        <div class="modal fade" id="choose-region-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Kecamatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="identity-container">
                            <div class="name">
                                <div class="title">Nama</div>
                                <div class="value">{{ selectedUser.name }}</div>
                            </div>
                            <div class="email">
                                <div class="title">Email</div>
                                <div class="value">{{ selectedUser.email }}</div>
                            </div>
                            <div class="phone-number">
                                <div class="title">Nomor Telepon</div>
                                <div class="value">{{ selectedUser.phone_number }}</div>
                            </div>
                            <div class="choose-district-container">
                                <div class="title">Kecamatan</div>
                                <div class="value">
                                    <select v-model="selectedRegionPage">
                                        <option :value="data" v-for="data in region">{{ data.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" @click="confirmationChangeUserToPicRegion()">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>
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
                    region_id: "",
                    name: "",
                    email: "",
                    password: "jayalahmbi",
                    birth_of_date: "",
                    phone_number: "",
                    password_confirmation: "jayalahmbi",
                    role: "pic_kecamatan",
                },
                loading: false,
                filter: {
                    page: 1,
                    per_page: 10,
                    text: ""
                },
                user: {
                    data: []
                },
                selectedUser: {},
                mounted: false,
                selectedRegionPage: ""
            }
        },
        computed: {
            userLogin: {
                get() {
                    return this.$store.getters["getUserLogin"];
                },
                set(value) {
                    this.$store.commit("setUserLogin", value);
                }
            },
            region: {
                get() {
                    return this.$store.getters["getRegion"]
                },
                set(value) {
                    this.$store.commit("setRegion", value)
                }
            },
            selectedRegion: {
                get() {
                    return this.$store.getters["getSelectedRegion"];
                },
                set(value) {
                    this.$store.commit("setSelectedRegion", value);
                }
            }
        },
        watch: {
            selectedRegion: {
                handler() {
                    if(!this.mounted && this.selectedRegion.name) {
                        this.mounted = true
                        this.formData.region_id = this.selectedRegion.id
                        this.selectedRegionPage = this.selectedRegion
                    }
                },
                deep: true,
                immediate: true
            }
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            PicRegionForm: () => import('./../form/_index'),
            Search: () => import('../../../../components/search/_index'),
            Paginate: () => import('../../../../components/paginate/_index')
        },
        mounted() {
            this.getUser()
        },
        methods: {
            savePicRegion() {
                this.loading = true

                this.formData.district_id = this.userLogin.district_id
                this.formData.password_confirmation = this.formData.password
                request.post('/api/user/create', this.formData, this.accessToken)
                .then((response) => {
                    this.loading = false

                    if(response.data.success) {
                        alert.success()
                        this.$refs.form.resetForm()
                    }else alert.error(response.data.message)
                })
            },
            getUser() {
                if(this.accessToken) {
                    request.get('/api/user/?filter[role]=user' +
                        '&filter[page]=' + this.filter.page +
                        '&filter[per_page]=' + this.filter.per_page +
                        '&filter[text]=' + this.filter.text +
                        '&filter[district_id]=' + this.userLogin.district_id,
                        this.accessToken)
                    .then((response) => {
                        if (response.data.success)
                            this.user = response.data.result
                    })
                }
            },
            search(text) {
                this.filter.text = text

                this.getUser()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getUser()
            },
            chooseRegionModal(data) {
                this.selectedUser = data

                $('#choose-region-modal').modal("show");
            },
            confirmationChangeUserToPicRegion() {
                $('#choose-region-modal').modal("hide");

                alert.confirmation( "Apakah anda yakin " + this.selectedUser.name + " akan menjadi PIC Kecamatan " + this.selectedRegionPage.name + "?",
                    "Yakin",
                    "Tidak")
                    .then((dialog) => {
                        if(dialog.value)
                            this.changeUserToPicRegion()
                    })
            },
            changeUserToPicRegion() {
                this.selectedUser.role = "pic_kecamatan"
                this.selectedUser.region_id = this.selectedRegionPage.id

                request.post('/api/user/update/' + this.selectedUser.id, this.selectedUser, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getUser()
                    }else {
                        alert.error()
                    }
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #add-pic-region
        padding-top 15px

    td > .fa,
    td > .fas
        padding 6px
        color white
        border-radius 4px
        cursor pointer
        background $orange

    .modal-body > .identity-container
        margin-top 5px

    .modal-body > .identity-container > .name,
    .modal-body > .identity-container > .email,
    .modal-body > .identity-container > .phone-number,
    .modal-body > .identity-container > .choose-district-container
        display flex
        margin-top 8px
        align-items center

    .modal-body > .identity-container > .name > .title,
    .modal-body > .identity-container > .email > .title,
    .modal-body > .identity-container > .phone-number > .title,
    .modal-body > .identity-container > .choose-district-container > .title
        flex 1

    .modal-body > .identity-container > .name > .value,
    .modal-body > .identity-container > .email > .value,
    .modal-body > .identity-container > .phone-number > .value,
    .modal-body > .identity-container > .choose-district-container > .value
        flex 2

    .modal-body > .identity-container > .choose-district-container > .value > select
        background white
        border-radius 3px
        padding 4px 6px
</style>
