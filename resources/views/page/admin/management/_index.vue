<template>
    <div id="district-management-admin">
        <panel title="Kelola Admin">
            <template slot="body">
                <div class="filter-container">
                    <select @change="getAdmin()" v-model="selectedDistrictId">
                        <option v-for="data in district" :value="data.id">{{ data.name }}</option>
                    </select>
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
                        <tr v-if="admin.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in admin.data" v-else>
                            <td>{{ index+1 }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.email }}</td>
                            <td>{{ data.phone_number }}</td>
                            <td width="100px" class="text-center">
                                <i class="fa fa-key" @click="confirmationResetPassword(data)"></i>
                                <i class="fa fa-trash" @click="confirmationRemoveAdmin(data)"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="admin" @changePaginate="changePaginateAdmin"></paginate>
            </template>
        </panel>
    </div>
</template>

<script>
    import request from "../../../../helper/request"
    import alert from "../../../../helper/alert"

    export default {
        props: ['accessToken'],
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            Search: () => import('../../../../components/search/_index'),
            Paginate: () => import('../../../../components/paginate/_index')
        },
        data() {
            return {
                selectedDistrictId: null,
                admin: {
                    data: []
                },
                adminFilter: {
                    page: 1,
                    per_page: 10,
                    text: ""
                },
                district: {}
            }
        },
        mounted() {
            this.getDistrict()
        },
        methods: {
            getDistrict() {
                if(this.accessToken) {
                    request.get('/api/district', this.accessToken)
                    .then((response) => {
                        if (response.data.success) {
                            if(response.data.result.data[0]) this.district = response.data.result.data
                            else this.district = [{id: null, name: 'Kebupaten tidak ditemukan'}]

                            this.selectedDistrictId = this.district[0].id
                            this.getAdmin()
                        }
                    })
                }
            },
            search(text) {
                this.adminFilter.text = text

                this.getAdmin()
            },
            changePaginateAdmin(data) {
                this.adminFilter.page = data.page
                this.adminFilter.per_page = data.per_page

                this.getAdmin()
            },
            getAdmin() {
                if(this.accessToken) {
                    request.get('/api/user/?filter[role]=admin' +
                        '&filter[district_id]=' + this.selectedDistrictId +
                        '&filter[page]=' + this.adminFilter.page +
                        '&filter[per_page]=' + this.adminFilter.per_page +
                        '&filter[text]=' + this.adminFilter.text,
                        this.accessToken)
                    .then((response) => {
                        if (response.data.success)
                            this.admin = response.data.result
                    })
                }
            },
            confirmationRemoveAdmin(data) {
                alert.confirmation('Apakah kamu yakin untuk menghapus admin ' + data.name + ' ?', 'Hapus', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.removeAdmin(data)
                })
            },
            confirmationResetPassword(data) {
                let password = "jayalahmbi"

                alert.confirmation('Apakah kamu yakin untuk atur ulang password admin ' + data.name + ' menjadi '+ '"' +password+ '"' +' ?', 'Ganti', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.resetPasswordAdmin(data, password)
                })
            },
            resetPasswordAdmin(data, password) {
                alert.loading()

                data.password = password
                request.post('/api/user/update/' + data.id, data, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getAdmin()
                    }else {
                        alert.error()
                    }
                })
            },
            removeAdmin(data) {
                alert.loading()

                data.role = "user"
                delete data.password
                request.post('/api/user/update/' + data.id, data, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getAdmin()
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

    #district-management-admin
        padding-top 15px

    .back-to-management
        padding-left 15px
        color $orange
        font-weight 700
        cursor pointer
        margin-top 1em

    .table-container
        margin-top 2em
        margin-bottom 1em

    .add-button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        cursor pointer

    .filter-container
        display flex
        align-items flex-end
        margin-top -1em

    .filter-container > select
        height 36px
        border 2px solid #eaeaea
        border-radius 8px
        background white
        margin-right 15px
        padding 0 5px
        width 220px

    option
        cursor pointer !important

    td > .fa,
    td > .fas
        padding 6px
        color white
        border-radius 4px
        cursor pointer

    td > .fa-trash
        background red

    td > .fa-key
        background $orange
</style>
