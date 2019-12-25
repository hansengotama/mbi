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
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.account_number_1 }}</td>
                            <td>{{ data.account_name_1 }}</td>
                            <td>
                                <span v-if="data.account_number_2">{{ data.account_number_2 }}</span>
                                <span v-else>-</span>
                            </td>
                            <td>
                                <span v-if="data.account_name_2">{{ data.account_name_2 }}</span>
                                <span v-else>-</span>
                            </td>
                            <td width="150px" class="text-center">
                                <i class="fa fa-edit" @click="editDistrict(data)"></i>
                                <i class="fa fa-trash" @click="confirmationDeleteDistrict(data)"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="district" @changePaginate="changePaginateDistrict"></paginate>
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
                        if(response.data.success)
                            this.district = response.data.result
                    })
                }
            },
            search(text) {
                this.districtFilter.text = text

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
                alert.loading()

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

    td > .fa,
    td > .fas
        padding 6px
        color white
        border-radius 4px
        cursor pointer

    td > .fa-edit
        margin-right 4px
        background $orange

    td > .fa-trash
        background red

    .circle
        color $orange
        font-weight 600
</style>
