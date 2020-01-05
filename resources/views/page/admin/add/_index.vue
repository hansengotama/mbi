<template>
    <div id="add-admin">
        <panel title="Tambah Admin (Jika belum memiliki akun)">
            <template slot="body">
                <admin-form :formData="formData"
                            :loading="loading"
                            :district="district"
                            @saveAdmin="saveAdmin"
                            ref="form"
                ></admin-form>
            </template>
        </panel>
        <panel title="Tambah Admin">
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
                                <i class="fa fa-tasks" @click="chooseDistrictModal(data)"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="user" @changePaginate="changePaginate"></paginate>
            </template>
        </panel>

        <!-- Modal -->
        <div class="modal fade" id="choose-district-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Kabupaten</h5>
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
                                <div class="title">Kabupaten</div>
                                <div class="value">
                                    <select v-model="selectedDistrict">
                                        <option :value="data" v-for="data in district">{{ data.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" @click="confirmationChangeUserToAdmin()">Lanjut</button>
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
                    district_id: "",
                    name: "",
                    email: "",
                    password: "jayalahmbi",
                    birth_of_date: "",
                    phone_number: "",
                    password_confirmation: "jayalahmbi",
                    role: "admin",
                },
                loading: false,
                district: [],
                filter: {
                    page: 1,
                    per_page: 10,
                    text: ""
                },
                user: {
                    data: []
                },
                selectedUser: {},
                selectedDistrict: null
            }
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            AdminForm: () => import('./../form/_index'),
            Search: () => import('../../../../components/search/_index'),
            Paginate: () => import('../../../../components/paginate/_index')
        },
        mounted() {
            this.getDistrict()
            this.getUser()
        },
        methods: {
            saveAdmin() {
                this.loading = true

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
            getDistrict() {
                if(this.accessToken) {
                    request.get('/api/district', this.accessToken)
                    .then((response) => {
                        if (response.data.success) {
                            if(response.data.result.data[0]) {
                                this.district = response.data.result.data
                                this.selectedDistrict = response.data.result.data[0]
                            }else {
                                this.district = [{id: null, name: 'Kabupaten tidak ditemukan'}]
                            }

                            this.formData.district_id = this.district[0].id
                        }
                    })
                }
            },
            getUser() {
                if(this.accessToken) {
                    request.get('/api/user/?filter[role]=user' +
                        '&filter[page]=' + this.filter.page +
                        '&filter[per_page]=' + this.filter.per_page +
                        '&filter[text]=' + this.filter.text,
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
            chooseDistrictModal(data) {
                this.selectedUser = data

                $('#choose-district-modal').modal("show");
            },
            confirmationChangeUserToAdmin() {
                $('#choose-district-modal').modal("hide");

                alert.confirmation( "Apakah anda yakin " + this.selectedUser.name + " akan menjadi Admin kabupaten " + this.selectedDistrict.name + "?",
                    "Yakin",
                    "Tidak")
                .then((dialog) => {
                    if(dialog.value)
                        this.changeUserToAdmin()
                })
            },
            changeUserToAdmin() {
                this.selectedUser.role = "admin"
                this.selectedUser.district_id = this.selectedDistrict.id

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

    #add-admin
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
