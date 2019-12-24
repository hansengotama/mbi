<template>
    <div id="district-management">
        <panel title="Kelola Kabupaten">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Nomor Rekening</th>
                            <th>Nama Rekening</th>
                            <th>Nomor Rekening (2)</th>
                            <th>Nama Rekening (2)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tr v-if="district.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in district.data" v-else>
                            <td @click="selectDistrict(data)">
                                <span v-if="selectedDistrict.id == data.id" class="circle">{{ index + 1 }}</span>
                                <span v-else>{{ index + 1 }}</span>
                            </td>
                            <td @click="selectDistrict(data)">{{ data.name }}</td>
                            <td @click="selectDistrict(data)">{{ data.account_number_1 }}</td>
                            <td @click="selectDistrict(data)">{{ data.account_name_1 }}</td>
                            <td @click="selectDistrict(data)">
                                <span v-if="data.account_number_2">{{ data.account_number_2 }}</span>
                                <span v-else>-</span>
                            </td>
                            <td @click="selectDistrict(data)">
                                <span v-if="data.account_name_2">{{ data.account_name_2 }}</span>
                                <span v-else>-</span>
                            </td>
                            <td width="100px" class="text-center">
                                <i class="fa fa-edit" @click="editDistrict(data)"></i>
                                <i class="fa fa-trash" @click="confirmationDeleteDistrict(data)"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="district" @changePaginate="changePaginateDistrict"></paginate>
            </template>
        </panel>
        <panel :title="'Admin ' + selectedDistrict.name">
            <template slot="body">
                <button class="add-button">+ Tambah</button>
                <div class="table-container">
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
                        <tr v-else>

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
                district: {
                    data: []
                },
                districtFilter: {
                    text: "",
                    page: 1,
                    per_page: 10
                },
                selectedDistrict: {
                    name: ""
                },
                admin: {
                    data: []
                },
                adminFilter: {
                    page: 1,
                    per_page: 10
                }
            }
        },
        mounted() {
            this.getDistrict()
        },
        methods: {
            getDistrict() {
                if(this.accessToken) {
                    request.get('/api/district?filter[text]='+ this.districtFilter.text + '&filter[page]='+ this.districtFilter.page +'&filter[per_page]=' + this.districtFilter.per_page, this.accessToken)
                    .then((response) => {
                        if(response.data.success) {
                            this.district = response.data.result
                            this.selectedDistrict = response.data.result.data[0]
                            this.getAdmin()
                        }
                    })
                }
            },
            search(text) {
                this.filter.text = text

                this.getDistrict()
            },
            changePaginateDistrict(data) {
                this.districtFilter.page = data.page
                this.districtFilter.per_page = data.per_page

                this.getDistrict()
            },
            confirmationDeleteDistrict(data) {
                alert.confirmation('Apakah kamu yakin untuk menghapus kecamatan ' + data.name + ' ?', 'Hapus', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.deleteDistrict(data.id)
                })
            },
            deleteDistrict(id) {
                request.post('/api/district/delete/'+id, null, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getDistrict()
                    }else
                        alert.error()
                })
            },
            editDistrict(data) {
                this.$router.push({
                    name: "Edit District",
                    params: {data: data}
                })
            },
            selectDistrict(data) {
                if(this.selectedDistrict.id != data.id) {
                    this.selectedDistrict = data
                }
            },
            changePaginateAdmin(data) {
                this.adminFilter.page = data.page
                this.adminFilter.per_page = data.per_page

                this.getAdmin()
            },
            getAdmin() {

            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #district-management
        padding-top 15px

    .table-container
        margin-top 2em
        margin-bottom 1em

    td > .fa
        padding 6px
        color white
        border-radius 4px
        cursor pointer

    td > .fa-edit
        margin-right 4px
        background $orange

    td > .fa-trash
        background red

    td
        cursor pointer

    .circle
        color $orange
        font-weight 600

    .add-button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        cursor pointer
</style>
